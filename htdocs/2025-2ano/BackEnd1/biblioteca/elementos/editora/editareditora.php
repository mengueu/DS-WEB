<?php
    require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['nomeeditora']) && isset($_POST['cidadesede'])) {
            
            $nomeeditora = $_POST['nomeeditora'];
            $cidadesede = $_POST['cidadesede'];
            $codigoeditora = $_GET['codigoeditora'];

            $sql = "UPDATE editora SET nomeeditora = '$nomeeditora', cidadesede = '$cidadesede' WHERE codigoeditora = $codigoeditora";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: /biblioteca/editora.php");
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
    <link rel="stylesheet" href="editora.css">
    <title>Editar Editora</title>
</head>
<body class="bodyeditar">
    <?php
        $codigoeditora = $_GET['codigoeditora'];
        $sql = "SELECT * FROM editora WHERE codigoeditora = $codigoeditora";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: /biblioteca/elementos/editora/editareditora.php");
            exit;
        }
    ?>

    <div class="voltar">
        <a href="/biblioteca/editora.php">Voltar</a>
    </div>

    <h1 class="titulo">Edição de Editora:</h1>

    <div class="atuais">
        <h2>Dados Atuais:</h2>
        <label for="nomeeditora" class="editar2">Nome da Editora: <?=$linha['nomeeditora'];?> </label>
        <br><br>
        <label for="cidadesede" class="editar2">Email da Editora: <?=$linha['cidadesede'];?></label>
    </div>

    <div class="novos">
        <h2>Novos Dados:</h2>
        <form action="editareditora.php?codigoeditora=<?=$codigoeditora?>" method="POST">
        
            <label for="nomeeditora">Nome da Editora:</label>
            <input type="text" id="nome" name="nomeeditora" class="editar1"><br><br>

            <label for="cidadesede">Cidade Sede da Editora:</label>
            <input type="text" id="cidade" name="cidadesede" class="editar1"><br><br>

            <button type="submit" class="editar">Editar</button>
        </form>
    </div>
</body>
</html>