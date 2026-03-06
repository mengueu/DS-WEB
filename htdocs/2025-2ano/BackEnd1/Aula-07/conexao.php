<?php
    $hostDB = 'localhost';
    $usuarioDB = 'root';
    $senhaDB = '';
    $bancoDB = 'db_usuarios';
    
    // Conectar ao banco de dados
    $conexao = mysqli_connect($hostDB, $usuarioDB, $senhaDB, $bancoDB);

    // Verificar a conexão
    if (!$conexao) {
        die("<br>Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
    mysqli_set_charset($conexao, "utf8"); // Definir o conjunto de caracteres para UTF-8
?>