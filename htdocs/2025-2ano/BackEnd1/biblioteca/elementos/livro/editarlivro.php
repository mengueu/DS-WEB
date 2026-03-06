<?php
    require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['titulo']) && isset($_POST['anopublicacao'])) {
            
            $titulo = $_POST['titulo'];
            $anopublicacao = $_POST['anopublicacao'];
            $codigolivro = $_GET['codigolivro'];

            $sql = "UPDATE livro SET titulo = '$titulo', anopublicacao = '$anopublicacao' WHERE codigolivro = $codigolivro";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: /biblioteca/livro.php");
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
    <link rel="stylesheet" href="livro.css">
    <title>Editar Livro</title>
</head>
<body class="bodyeditar">
    <?php
        $codigolivro = $_GET['codigolivro'];
        $sql = "SELECT * FROM livro WHERE codigolivro = $codigolivro";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: /biblioteca/elementos/livro/editarlivro.php");
            exit;
        }
    ?>

    <div class="voltar">
        <a href="/biblioteca/livro.php">Voltar</a>
    </div>

    <h1 class="titulo">Edição de Livros:</h1>

    <div class="atuais">
        <h2>Dados Atuais:</h2>
        <label for="titulo" class="editar2">Nome do Livro: <?=$linha['titulo'];?> </label>
        <br><br>
        <label for="anopublicacao" class="editar2">Ano de Publicação do Livro: <?=$linha['anopublicacao'];?></label>
    </div>

    <div class="novos">
        <h2>Novos Dados:</h2>
        <form action="editarlivro.php?codigolivro=<?=$codigolivro?>" method="POST">
            <label for="titulo">Nome do Livro:</label>
            <input type="text" id="titulo" name="titulo" class="editar1"><br><br>

            <label for="anopublicacao">Ano de Publicação do Livro:</label>
            <input type="text" id="ano" name="anopublicacao" class="editar1"><br><br>

            <button type="submit" class="editar">Editar</button>
        </form>
    </div>
</body>
</html>