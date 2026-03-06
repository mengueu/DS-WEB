<?php
    require_once 'elementos\conexaobiblioteca.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elementos/editora/editora.css">
    <title>Editora</title>
</head>
<body class="bodyinicio">
    <div class="voltar">
        <a href="index.php">Voltar à Página Inicial</a>
    </div>
    
    <div class="cadastro">
    <h2>Cadastrar Nova Editora:</h2>
        <form method="post" action="elementos/editora/cadastraeditora.php">
            <label for="nome">Nome da Editora:*</label>
            <input type="text" id="nome" name="nome"><br><br>

            <label for="cidade">Cidade Sede:*</label>
            <input type="text" id="cidade" name="cidade"><br><br>

            <input type="submit" value="Informar">
        </form>
    </div>

    <br><br>

    <div class="cadastrados">
        <h2>Consultar Editoras Cadastradas:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade Sede</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        <?php
            $sql = "SELECT * FROM editora";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>" . $linha['codigoeditora'] . "</td>
                            <td>" . $linha['nomeeditora'] . "</td>
                            <td>" . $linha['cidadesede'] . "</td>
                            <td><button class='editar'><a href='elementos/editora/editareditora.php? codigoeditora=" . $linha['codigoeditora'] . "'>Editar</a></button></td>
                            <td><button class='deletar'><a href='elementos/editora/deletareditora.php? codigoeditora=" . $linha['codigoeditora'] . "'>Deletar</a></button></td>
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
