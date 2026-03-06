<?php
    require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['nomeautor']) && isset($_POST['nacionalidadeautor'])) {
            
            $nomeautor = $_POST['nomeautor'];
            $nacionalidadeautor = $_POST['nacionalidadeautor'];
            $codigoautor = $_GET['codigoautor'];

            $sql = "UPDATE autor SET nomeautor = '$nomeautor', nacionalidadeautor = '$nacionalidadeautor' WHERE codigoautor = $codigoautor";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: /biblioteca/autor.php");
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
    <link rel="stylesheet" href="autor.css">
    <title>Editar Autor</title>
</head>
<body class="bodyeditar">
    <?php
        $codigoautor = $_GET['codigoautor'];
        $sql = "SELECT * FROM autor WHERE codigoautor = $codigoautor";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: /biblioteca/elementos/autor/editarautor.php");
            exit;
        }
    ?>

    <div class="voltar">
        <a href="/biblioteca/autor.php">Voltar</a>
    </div>

    <h1 class="titulo">Edição de Autor:</h1>

    <div class="atuais">
        <h2>Dados Atuais:</h2>
        <label for="nomeautor" class="editar2">Nome do Autor: <?=$linha['nomeautor'];?> </label>
        <br><br>
        <label for="nacionalidadeautor" class="editar2">Nacionalidade do Autor: <?=$linha['nacionalidadeautor'];?></label>
    </div>

    <div class="novos">
        <h2>Novos Dados:</h2>
        <form action="editarautor.php?codigoautor=<?=$codigoautor?>" method="POST">
            
            <label for="nomeautor">Nome do Autor:*</label>
            <input type="text" id="nomeautor" name="nomeautor" class="editar1"><br><br>

            <label for="nacionalidadeautor">Nacionalidade:*</label>
                <select id="nacionalidadeautor" name="nacionalidadeautor" class="editar1">
                    <optgroup label="Selecione uma:">
                        <option value="Brasileiro">Brasileiro</option>
                        <option value="Argentino">Argentino</option>
                        <option value="Espanhol">Espanhol</option>
                        <option value="Americano">Americano</option>
                        <option value="Britânico">Britânico</option>
                        <option value="Japonês">Japonês</option>
                        <option value="Outros">Outro</option>
                        <option value="Não Informado">Não sei</option>
                    </optgroup>
                </select>
                <br><br>
        
            <button type="submit" class="editar">Editar</button>
        </form>
    </div>  
</body>
</html>