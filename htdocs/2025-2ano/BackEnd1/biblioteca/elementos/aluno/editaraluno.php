<?php
    require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['nomealuno']) && isset($_POST['emailaluno']) && isset($_POST['telefonealuno'])) {
            
            $nomealuno = $_POST['nomealuno'];
            $emailaluno = $_POST['emailaluno'];
            $telefonealuno = $_POST['telefonealuno'];
            $codigoaluno = $_GET['codigoaluno'];

            $sql = "UPDATE aluno SET nomealuno = '$nomealuno', emailaluno = '$emailaluno', telefonealuno = '$telefonealuno' WHERE codigoaluno = $codigoaluno";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: /biblioteca/aluno.php");
            } else {
                echo "Erro ao editar: " . mysqli_error($conexao);
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aluno.css">
    <title>Editar Aluno</title>
</head>
<body class="bodyeditar">
    <?php
        $codigoaluno = $_GET['codigoaluno'];
        $sql = "SELECT * FROM aluno WHERE codigoaluno = $codigoaluno";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: /biblioteca/elementos/aluno/editaraluno.php");
            exit;
        }
    ?>

    <div class="voltar">
        <a href="/biblioteca/aluno.php">Voltar</a>
    </div>
      
    <h1 class="titulo">Edição de Alunos:</h1>
        
    <div class="atuais">
        <h2>Dados Atuais:</h2>
        <label for="nomealuno" class="editar2">Nome do Aluno: <?=$linha['nomealuno'];?> </label>
        <br><br>
        <label for="emailaluno" class="editar2">Email do Aluno: <?=$linha['emailaluno'];?></label>
        <br><br>
        <label for="telefonealuno" class="editar2">Telefone do Aluno: <?= $linha['telefonealuno'];?></label>
    </div>

    <div class="novos">
        <h2>Novos Dados:</h2>
        <form action="editaraluno.php?codigoaluno=<?=$codigoaluno?>" method="POST">
            
            <label for="nomealuno">Nome do Aluno:</label><br>
            <input type="text" id="nome" name="nomealuno" class="editar1"><br><br>

            <label for="emailaluno">Email do Aluno:</label><br>
            <input type="email" id="email" name="emailaluno" placeholder="emailaluno@exemplo.com" class="editar1"><br><br>

            <label for="telefonealuno">Telefone do Aluno:</label><br>   
            <input type="text" id="telefone" name="telefonealuno" class="editar1"><br><br>

            <button type="submit" class="editar">Editar</button>
        </form>
    </div> 
</body>
</html>