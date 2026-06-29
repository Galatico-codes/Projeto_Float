<?php
    include "../Conexao/conexao.php";

    header('Content-Type: application/json' );
    
    $query = "SELECT * FROM usuarios";

    $total = mysqli_query($ocon, $query);

    $tudo = [];

    while($linha = mysqli_fetch_assoc($total)){
        $tudo[] = $linha;
    }

echo json_encode($tudo);
?>