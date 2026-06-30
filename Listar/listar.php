<?php
header('Content-Type: application/json');

// Inclui o arquivo que criamos acima (ele vai gerar a variável $ocon válida)
include dirname(__DIR__) . "/Conexao/conexao.php";

$query = "SELECT * FROM usuarios";
$total = mysqli_query($ocon, $query);

$tudo = [];

if ($total) {
    while($linha = mysqli_fetch_assoc($total)){
        $tudo[] = $linha;
    }
} else {
    // Se a query falhar, avisa o motivo
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro na query: ' . mysqli_error($ocon)
    ]);
    exit;
}

// Fecha a conexão somente aqui, no final de tudo
mysqli_close($ocon);

// Exibe o resultado final
echo json_encode($tudo);
?>
