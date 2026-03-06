<?php
    require_once 'elementos\conexaobiblioteca.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elementos/autor/autor.css">
    <title>Autor</title>
</head>
<body class="bodyinicio">
    <div class="voltar">
        <a href="index.php">Voltar à Página Inicial</a>
    </div>
    
    <div class="cadastro">
        <h2>Cadastrar Novo Autor:</h2>
            <form method="post" action="elementos/autor/cadastraautor.php">
            <label for="nomeautor">Nome:*</label>
            <input type="text" id="nomeautor" name="nomeautor"><br><br>

            <label for="nacionalidadeautor">Nacionalidade:*</label>
            <select id="nacionalidadeautor" name="nacionalidadeautor">
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
            <input type="submit" value="Informar">
    </div>

        <br><br>

        <div class="cadastrados">
        <h2>Consultar Autores Cadastrados:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Nacionalidade</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        <?php
            $sql = "SELECT * FROM autor";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>" . $linha['codigoautor'] . "</td>
                            <td>" . $linha['nomeautor'] . "</td>
                            <td>" . $linha['nacionalidadeautor'] . "</td>
                            <td><button class='editar'><a href='elementos/autor/editarautor.php? codigoautor=" . $linha['codigoautor'] . "'>Editar</a></button></td>
                            <td><button class='deletar'><a href='elementos/autor/deletarautor.php? codigoautor=" . $linha['codigoautor'] . "'>Deletar</a></button></td>
                        </tr>";
                }
            } else {
                echo "<br>Nenhum dado encontrado";
            }
        ?>
        </table>
    </div>
    </form>
</body>
</html>
