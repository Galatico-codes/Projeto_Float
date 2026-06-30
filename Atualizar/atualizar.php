<?php
header('Content-Type: application/json');

// CORREÇÃO 1: Adicionada a barra "/" antes de Conexao exigida pelo Linux
include dirname(__DIR__) . "/Conexao/conexao.php";

// Como o Android envia MultipartBody, lemos diretamente do $_POST e $_FILES
$id    = $_POST["id"] ?? null;
$nome  = $_POST["nome"] ?? null;
$senha = $_POST["senha"] ?? null;
$email = $_POST["email"] ?? null;
$foto  = $_FILES["foto"] ?? null;

// Validação básica para não quebrar a consulta
if (!$id || !$nome || !$email) {
    echo json_encode(["status" => "erro", "mensagem" => "Dados textuais incompletos recebidos."]);
    exit;
}

$id = (int)$id; 
$query = "SELECT nome, email, senha, hashFoto, caminhoFoto FROM usuarios WHERE id = $id";
$resultado = mysqli_query($ocon, $query);
$atual = mysqli_fetch_assoc($resultado);

if (!$atual) {
    echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado no banco."]);
    exit;
}

$hashAtual = $atual['hashFoto'];
$caminhoFoto = $atual['caminhoFoto'];
$fotoEnviada = false;

// Verifica se uma nova foto foi enviada sem erros
if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
    $tempFoto = $foto["tmp_name"];
    
    // Calcula o hash baseado no arquivo temporário correto
    $hashAtual = hash_file("sha256", $tempFoto);
    
    $extensao = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $novoNomeArquivo = $hashAtual . '.' . $extensao;
    
    // CORREÇÃO 2: Caminho absoluto para garantir escrita correta no servidor Linux
    $diretorioDestino = dirname(__DIR__) . "/ImagemUsuario/"; 
    $caminhoFoto = "ImagemUsuario/" . $novoNomeArquivo;
    
    $fotoEnviada = true;
}

// Compara se QUALQUER informação mudou
if ($atual['nome'] != $nome || 
    $atual['senha'] != $senha || 
    $atual['email'] != $email || 
    $atual['hashFoto'] != $hashAtual) {
    
    if ($fotoEnviada) {
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
        }
        // Move usando o caminho físico absoluto do servidor
        move_uploaded_file($tempFoto, $diretorioDestino . $novoNomeArquivo);
    }
    
    $nomeEscapado = mysqli_real_escape_string($ocon, $nome);
    $emailEscapado = mysqli_real_escape_string($ocon, $email);
    $senhaEscapada = mysqli_real_escape_string($ocon, $senha);
    
    $sql = "UPDATE usuarios 
            SET nome = '$nomeEscapado', 
                email = '$emailEscapado', 
                senha = '$senhaEscapada', 
                hashFoto = '$hashAtual', 
                caminhoFoto = '$caminhoFoto' 
            WHERE id = $id";
            
    if (mysqli_query($ocon, $sql)) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Atualizado!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => mysqli_error($ocon)]);
    }
} else {
    echo json_encode(["status" => "sucesso", "mensagem" => "Nada mudou"]);
}

mysqli_close($ocon);
?>
