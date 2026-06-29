<?php
header('Content-Type: application/json');

$ocon = mysqli_connect(
        getenv('MYSQLHOST') ?: "localhost",
        getenv('MYSQLUSER') ?: "root",
        getenv('MYSQLPASSWORD') ?: "",
        getenv('MYSQL_DATABASE') ?: "usuarios",
        getenv('MYSQLPORT') ?: "3306"
);

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
