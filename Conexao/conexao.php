<?php
// Pega as variáveis de ambiente do Railway ou usa os padrões antigos caso falhe
$host = getenv('MYSQLHOST') ?: 'railway';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQL_ROOT_PASSWORD') ?: 'CYVrvyfqSINERaJYfNkrWTGlLVobpFUa';
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
