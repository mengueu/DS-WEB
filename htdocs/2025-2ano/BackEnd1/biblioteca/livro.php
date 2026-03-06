<?php
    require_once 'elementos\conexaobiblioteca.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elementos/livro/livro.css">
    <title>Livro</title>
</head>
<body class="bodyinicio">
    <div class="voltar">
        <a href="index.php">Voltar à Página Inicial</a>
    </div>
    <div class="cadastro">
    <h2>Cadastrar Novos Livros:</h2>
        <form method="post" action="elementos/livro/cadastralivro.php">
            <label for="titulo">Título:*</label>
            <input type="text" id="titulo" name="titulo"><br><br>

            <label for="ano">Ano de Publicação:*</label>
            <input type="number" id="ano" name="ano"><br><br><br>

            <input type="submit" value="Informar">
        </form>
    </div>

    <br><br>

    <div class="cadastrados">
        <h2>Consultar Livros Cadastrados:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Ano de Publicação</th>
                <th>Código do Autor</th>
                <th>Código da Editora</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        <?php
            $sql = "SELECT * FROM livro";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>" . $linha['codigolivro'] . "</td>
                            <td>" . $linha['titulo'] . "</td>
                            <td>" . $linha['anopublicacao'] . "</td>
                            <td>" . $linha['fk_Autor_codigoautor'] . "</td>
                            <td>" . $linha['fk_Editora_codigoeditora'] . "</td>
                            <td><button class='editar'><a href='elementos/livro/editarlivro.php? codigolivro=" . $linha['codigolivro'] . "'>Editar</a></button></td>
                            <td><button class='deletar'><a href='elementos/livro/deletarlivro.php? codigolivro=" . $linha['codigolivro'] . "'>Deletar</a></button></td>
                        </tr>";
                }
            } else {
                echo "<br>Nenhum dado encontrado";
            }
        ?>
        </table>
    </div>
</body>
</html>
