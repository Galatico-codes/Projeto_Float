<?php
include "../Conexao/conexao.php";

header('Content-Type: application/json' );

$id = $_POST["id"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];
$foto = $_FILES["foto"];

// 1. Busca os dados atuais do banco para comparação
// (Protegido contra injeção de SQL convertendo o ID para inteiro)
$id = (int)$id; 
$query = "SELECT nome, email, senha, hashFoto, caminhoFoto FROM usuarios WHERE id = $id";
$resultado = mysqli_query($ocon, $query);
$atual = mysqli_fetch_assoc($resultado);

// 2. Inicializa as variáveis com os valores atuais do banco (caso o usuário não envie uma foto nova)
$hashAtual = $atual['hashFoto'];
$caminhoFoto = $atual['caminhoFoto'];
$fotoEnviada = false;

// 3. Verifica se uma nova foto foi enviada sem erros
if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
    $tempFoto = $foto["tmp_name"];
    
    // Calcula o hash baseado no arquivo temporário correto
    $hashAtual = hash_file("sha256", $tempFoto);
    
    $extensao = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $novoNomeArquivo = $hashAtual . '.' . $extensao;
    
    // Define a pasta onde as fotos ficam salvas (ajuste se necessário)
    $diretorioDestino = "ImagemUsuario/"; 
    $caminhoFoto = $diretorioDestino . $novoNomeArquivo;
    
    $fotoEnviada = true;
}

// 4. Compara se QUALQUER informação mudou (incluindo o hash da foto)
if ($atual['nome'] != $nome || 
    $atual['senha'] != $senha || 
    $atual['email'] != $email || 
    $atual['hashFoto'] != $hashAtual) {
    
    // 5. Se uma nova foto foi enviada, move ela para a pasta final antes de atualizar o banco
    if ($fotoEnviada) {
        // Cria a pasta uploads caso ela não exista
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
        }
        move_uploaded_file($tempFoto, $caminhoFoto);
    }
    
    // 6. Executa o UPDATE com os valores novos ou mantidos
    // (Escapando as strings para evitar quebras por aspas no nome ou senha)
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
        echo "Atualizado!";
    } else {
        echo "Erro ao atualizar: " . mysqli_error($ocon);
    }
} else {
    echo "Nada mudou";
}
?>
