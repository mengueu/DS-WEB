<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle do Arduino - Início</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 480px;
            margin: 80px auto;
            text-align: center;
            color: #222;
        }
        h2 {
            margin-bottom: 8px;
        }
        p.sub {
            color: #666;
            margin-bottom: 30px;
        }
        .opcoes {
            display: flex;
            gap: 16px;
            justify-content: center;
        }
        .opcoes > div {
            flex: 1;
        }
        a.botao {
            display: block;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-decoration: none;
            color: #222;
            font-weight: bold;
            font-size: 18px;
        }
        a.botao:hover {
            background: #f2f2f2;
        }
        p.desc {
            font-size: 13px;
            color: #666;
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <h2>Painel de Controle - Arduino</h2>
    <p class="sub">Escolha o método usado para enviar os comandos</p>

    <div class="opcoes">
        <div>
            <a class="botao" href="get.php">GET</a>
            <p class="desc">Comandos enviados pela URL</p>
        </div>
        <div>
            <a class="botao" href="post.php">POST</a>
            <p class="desc">Comandos enviados no corpo da requisição</p>
        </div>
    </div>
</body>
</html>
