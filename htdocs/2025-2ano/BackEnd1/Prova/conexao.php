<?php
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'db_filmes';
    
    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("<br>Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
    mysqli_set_charset($conexao, "utf8");
?>