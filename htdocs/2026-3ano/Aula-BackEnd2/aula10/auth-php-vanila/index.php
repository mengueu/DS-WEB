<?php
    session_start();
    
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business System</title>
    <link rel="shortcut icon" type="imagex/png" href="./assets/img/ico.svg">
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
    <div>
        <ul>
            <li><a href="" class="meumenu meumenu-active" title="Home">Home</a></li>
            <li><a href="cliente.php" class="meumenu" title="Clientes">Clientes</a></li>
            <li><a href="produto.php" class="meumenu" title="Produtos">Produtos</a></li>
            <li><a href="venda.php" class="meumenu" title="Vendas">Vendas</a></li>
            <li><a href="logout.php" class="meumenu" title="Sair">Sair</a></li>
        </ul>
    </div>
    <div class="container">    
        <hr>
        <h1>Dashboard</h1>
        <p>Os gráficos e exibições de informações encontram-se em desenvolvimento, os unicos dados encontrados foram:</p>

    </div>
</body>
<script src="./assets/js/script.js"></script>
</html>