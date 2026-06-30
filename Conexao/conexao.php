<?php
header('Content-Type: application/json');

// Pega as variáveis de ambiente corretas do Railway
$host = getenv('MYSQLHOST') ?: 'railway';
$user = getenv('MYSQLUSER') ?: '';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db   = getenv('MYSQL_DATABASE') ?: 'railway';
$port = getenv('MYSQLPORT') ?: 3306;

// Faz a conexão apenas UMA vez
$ocon = mysqli_connect($host, $user, $pass, $db, $port);

if (!$ocon) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Falha na conexão: ' . mysqli_connect_error()
    ]); 
    exit;
}

// Executa a busca
$query = "SELECT * FROM usuarios";
$total = mysqli_query($ocon, $query);

$tudo = [];

if ($total) {
    while($linha = mysqli_fetch_assoc($total)){
        $tudo[] = $linha;
    }
}

// Fecha a conexão para não travar o banco
mysqli_close($ocon);

// Retorna o resultado
echo json_encode($tudo);
?>
