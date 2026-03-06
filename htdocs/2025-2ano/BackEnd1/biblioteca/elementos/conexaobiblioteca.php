<?php
    $hostDB = 'localhost';
    $usuarioDB = 'root';
    $senhaDB = '';
    $bancoDB = 'db_biblioteca';
    
    $conexao = mysqli_connect($hostDB, $usuarioDB, $senhaDB, $bancoDB);

    if (!$conexao) {
        die("<br>Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
    mysqli_set_charset($conexao, "utf8");
?>