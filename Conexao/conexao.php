<?php
// Set the JSON content type just once
header('Content-Type: application/json');

// Correctly wrapped environment variables and fallback defaults with quotes
$host = getenv('MYSQLHOST') ?: 'railway';
$user = getenv('MYSQLUSER') ?: 'mysql.railway.internal';
$pass = getenv('MYSQLPASSWORD') ?: 'CYVrvyfqSINERaJYfNkrWTGlLVobpFUa';
$db   = getenv('MYSQL_DATABASE') ?: 'railway';
$port = getenv('MYSQLPORT') ?: 3306;

$ocon = mysqli_connect($host, $user, $pass, $db, $port);

$resposta = array(); 

// Erro se a conexão der errado
if (!$ocon) {
    $resposta['status'] = 'erro';
    $resposta['mensagem'] = 'Falha na conexão com o banco de dados';
    echo json_encode($resposta); 
    exit;
}
?>
