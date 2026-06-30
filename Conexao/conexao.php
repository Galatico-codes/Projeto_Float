<?php
header('Content-Type: application/json; charset=utf-8');

// Desativa qualquer travamento de timeout do PHP
ini_set('default_socket_timeout', 2);

$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQL_DATABASE');
$port = getenv('MYSQLPORT') ?: 3306;

// Se as variáveis estiverem vazias, avisa o Android na hora em vez de tentar conectar e travar
if (!$host || !$user) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'As variaveis de ambiente do Railway estao vazias ou os servicos nao estao vinculados.'
    ]);
    exit;
}
?>
