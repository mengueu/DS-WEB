<?php
    require_once 'conexao.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['titulo']) && isset($_POST['sinopse']) && isset($_POST['ano_lancamento']) && isset($_POST['genero'])) {
            
            $titulo = $_POST['titulo'];
            $sinopse = $_POST['sinopse'];
            $ano_lancamento = $_POST['ano_lancamento'];
            $genero = $_POST['genero'];

            $sql = "UPDATE filmes SET titulo = '$titulo', sinopse = '$sinopse', ano_lancamento = $ano_lancamento, genero = '$genero' WHERE idFilme = " . $_GET['idFilme'];
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: index.php");
            } else {
                echo "Por favor, preencha todos os campos obrigatórios.";
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
    <link rel="stylesheet" href="style.css">
    <title>Editar Filmes</title>
</head>
<body class="bodyeditar">
    <?php
        $idFilme = $_GET['idFilme'];
        $sql = "SELECT * FROM filmes WHERE idFilme = $idFilme";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: index.php");
            exit;
        }
    ?>

    <div class="voltar">
        <a href="index.php">Voltar à Página Inicial</a>
    </div>
      
    <h1 class="titulo">Edição de Filmes:</h1>
   
    <div class="atuais">
        <h2>Dados Atuais:</h2>

        <p>Título do Filme:</p>
        <label for="titulo" class="dados"><?=$linha['titulo'];?> </label>
        <br><br>
        <p>Sinopse do Filme:</p>
        <label for="sinopse" class="dados"><?=$linha['sinopse'];?> </label>
        <br><br>
        <p>Ano de Lançamento do Filme:</p>
        <label for="ano_lancamento" class="dados"><?=$linha['ano_lancamento'];?> </label>
        <br><br>
        <p>Gênero do Filme:</p>
        <label for="genero" class="dados"><?=$linha['genero'];?> </label>
    </div>

    <div class="novos">
        <h2>Novos Dados:</h2>
        <form action="editar.php?idFilme=<?=$idFilme?>" method="POST">
            
            <label for="titulo">Novo Título:*</label><br>
            <input type="text" id="titulo" name="titulo"><br><br>

            <label for="sinopse">Nova Sinopse:*</label><br>
            <textarea id="sinopse" name="sinopse" rows="6" cols="60" max-length="300"></textarea><br><br>

            <label for="ano_lancamento">Novo Ano de Lançamento:*</label><br>
            <input type="number" id="ano_lancamento" name="ano_lancamento"><br><br>

            <label for="genero">Novo Gênero:*</label><br>
            <select id="genero" name="genero">
                <optgroup label="Selecione uma:">
                    <option value="Ficção Científica">Ficção Científica</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Romance/Drama">Romance/Drama</option>
                    <option value="Animação">Animação</option>
                    <option value="Não Informado">Não sei</option>
                </optgroup>
            </select>
            <br><br>

            <button type="submit" class="editar">Editar</button>
        </form>
    </div>
</body>
</html>