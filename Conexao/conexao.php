<?php
// Lê as variáveis de ambiente oficiais que o Railway injeta no contêiner
$host = getenv('MYSQLHOST') ?: 'localhost';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db   = getenv('MYSQL_DATABASE') ?: 'railway';
$port = getenv('MYSQLPORT') ?: 3306;

// Abre a conexão
$ocon = mysqli_connect($host, $user, $pass, $db, $port);

if (!$ocon) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Falha na conexão: ' . mysqli_connect_error()
    ]); 
    exit;
}
?>
