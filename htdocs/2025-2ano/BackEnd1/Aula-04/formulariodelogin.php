<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Longin</title>
</head>
<body>
    <h1>Formulário de Login</h1>
    <form action="" method="post">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="login" name="login" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="senha" id="senha" name="senha" required>
        <br><br>
        <input type="submit" value="Entrar">
        <br><br>

        <?php
            // var_dump($_SERVER); - O bruno tava mostrando isso na aula pra ver os dados do servidor

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login = $_POST['login']; // Pega os dados recebidos do formulário na parte "login" pelo método POST
                $senha = $_POST['senha'];
            }

            echo ("<h2>Verificação de usuário:</h2>");

            if ($login == "Bruno" && $senha == "1234") {
                echo "Login bem-sucedido! Bem-vindo, " . $login . ".";
                header("Location: https://www.santosfc.com.br/"); // Redireciona para a página index.php
            } 
            else {
                echo "Nome de usuário ou senha incorretos.";
            }
        ?>
</body>
</html>