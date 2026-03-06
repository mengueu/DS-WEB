<?php
    require_once 'conexao.php';
    echo "<br><br>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tabela populada com PHP</title>
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
                <th>Data de Criação</th>
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