<?php
    session_start();
    if(isset($_SESSION['login'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <label>Login: </label>
            <input type="text" name="login">
            <br>
            <label>Senha: </label>
            <input type="password" name="senha">
            <br>
            <?php
                if(isset($_SESSION["erro"])){
                    echo ($_SESSION["erro"]);
                    unset($_SESSION["erro"]);
                }
            ?>
            <input type="submit">
        </form>
    </div>
    <br><br>
    Login: bruno@gmail.com 
    <br>
    Senha: 123
</body>
</html>

<?php

    //Verifica se veio do Formulário
    if(isset($_POST['login'])){
        //Verifica se o login esta correto
        include_once('conexao.php');
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM administrador WHERE email = '$login' and senha = '$senha'";
        $resultado = mysqli_query($conexao, $sql);    
        // Verifica se há registros
        if (mysqli_num_rows($resultado) > 0) {
            //Converte em Array Associativo
            $linha = mysqli_fetch_assoc($resultado);
            //Grava os dados na sessão
            $_SESSION['login'] = $linha['email'];
            
            header("Location: index.php");
        }else{
            $_SESSION['erro'] = "Login ou senha invalida";
            header("Location: index.php");
        }

    }
?>