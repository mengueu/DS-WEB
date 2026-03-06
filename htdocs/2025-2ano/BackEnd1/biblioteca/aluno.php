<?php
    require_once 'elementos\conexaobiblioteca.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elementos/aluno/aluno.css">
    <title>Aluno</title>
</head>
<body class="bodyinicio"> 
    <div class="voltar">
        <a href="index.php">Voltar à Página Inicial</a>
    </div>

    <div class="cadastro">
        <h2>Cadastrar Novo Aluno:</h2>
        <form method="post" action="elementos/aluno/cadastraaluno.php">
            <label for="nome">Nome:*</label><br>
            <input type="text" id="nome" name="nome"><br><br>

            <label for="email">Email:*</label><br>
            <input type="email" id="email" name="email"><br><br>

            <label for="telefone">Telefone:*</label><br>
            <input type="number" id="telefone" name="telefone"><br><br><br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </div>

    <br><br>

    <div class="cadastrados">
        <h2>Consultar Alunos Cadastrados:</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        <?php
            $sql = "SELECT * FROM aluno";

            $resultado = mysqli_query($conexao, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>" . $linha['codigoaluno'] . "</td>
                            <td>" . $linha['nomealuno'] . "</td>
                            <td>" . $linha['emailaluno'] . "</td>
                            <td>" . $linha['telefonealuno'] . "</td>
                            <td><button class='editar'><a href='elementos/aluno/editaraluno.php?codigoaluno=" . $linha['codigoaluno'] . "'>Editar</a></button></td>
                            <td><button class='deletar'><a href='elementos/aluno/deletaraluno.php?codigoaluno=" . $linha['codigoaluno'] . "'>Deletar</a></button></td>
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

