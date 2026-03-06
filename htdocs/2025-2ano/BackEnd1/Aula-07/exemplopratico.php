<?php
    require_once 'conexao.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar/Delete</title>
</head>
<body>
    <div class="cadastro">
        <h1>Cadastro de Usuários:</h1>
        <form method="POST" action="cadastro.php">
        <label for="nome">Nome do Usuário:</label>
        <input type="text" id="nome" name="nome"><br><br>

        <label for="email">Email do Usuário:</label>
        <input type="email" id="email" name="email" placeholder="email@exemplo.com"><br><br>

        <label for="senha">Senha do Usuário:</label>
        <input type="password" id="senha" name="senha"><br><br>

        <button type="submit">Cadastrar</button>
    </div>

    <br><br>

    <div class="cadastrados">
        <h1>Usuários Cadastrados:</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Data de Cadastro</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
            <?php
                $sql = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conexao, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while ($linha = mysqli_fetch_assoc($resultado)) { // Loop através de todas as linhas do resultado
                        echo "<tr>
                                <td>" . $linha['id'] . "</td>
                                <td>" . $linha['nome'] . "</td>
                                <td>" . $linha['email'] . "</td>
                                <td>" . $linha['senha'] . "</td>
                                <td>" . $linha['data_criacao'] . "</td>
                                <td><button><a href='editar.php? id=" . $linha['id'] . "'>Editar</a></button></td>
                                <td><button><a href='deletar.php? id=" . $linha['id'] . "'>Deletar</a></button></td>
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