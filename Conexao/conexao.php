<?php
header('Content-Type: application/json');
//Inicia a conexão com o banco
$ocon = mysqli_connect(
        getenv('MYSQLHOST'),
        getenv('MYSQLUSER'),
        getenv('MYSQLPASSWORD'),
        getenv('MYSQL_DATABASE') /*?: "railway"*/,
        getenv('MYSQLPORT'));

//Cria a variável de retorno
$resposta = array();

//Erro se a conexão der errado
if(!$ocon){
    header('Content-Type: application/json');
    $resposta["status"] = "erro";
    $resposta["mensagem"] = "Falha na conexão com o banco de dados";
    echo json_encode($resposta);
    exit;
}
?>
