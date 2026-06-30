<?php
// 1. Procure pela variável MYSQL_URL do Railway.
// Se ela não estiver configurada no painel, COLE a string inteira de conexão pública entre as aspas simples abaixo:
$url_publica = getenv('MYSQL_URL') ?: 'mysql://root:CYVrvyfqSINERaJYfNkrWTGlLVobpFUa@mysql.railway.internal:3306/railway';

// Decodifica a URL para separar Host, Usuário, Senha e Porta automaticamente
$dados = parse_url($url_publica);

$host = $dados['host'];
$user = $dados['user'];
$pass = $dados['pass'];
$db   = substr($dados['path'], 1);
$port = $dados['port'] ?: 3306;

// Abre a conexão usando a rota pública estável
$ocon = mysqli_connect($host, $user, $pass, $db, $port);

if (!$ocon) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Falha na conexão pública: ' . mysqli_connect_error()
    ]); 
    exit;
}
?>
