<?php
header('Content-Type: application/json');

echo json_encode([
    "status" => "ok",
    "endpoints" => [
        "listar" => "/Listar/listar.php",
        "atualizar" => "/Atualizar/atualizar.php"
    ]
]);
