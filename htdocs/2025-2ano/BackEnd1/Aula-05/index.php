<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 5</title>
</head>
<body>
<?php
        echo "<h1> AULA 5 </h1>";
        echo "<h4><a href='validacao-filter_input/formulario.php'> Validação Filter Input </a></h4>";
        echo "<h4><a href='validacao-filter_var/formulario.php'> Validação Filter Var </a></h4>";
        echo "<h4><a href='validacao-simples/formulario.php'> Validação Simples </a></h4>";
        echo "<h4><a href='Atividades/indexatividades.php'> Atividades </a></h4>";
    ?>
    <h1>Validação de formulários</h1>

    <h2>Conceitos</h2>
    <table border="1">
        <tr>
            <th>Função / Operador</th>
            <th>O que faz</th>
            <th>Exemplo</th>
        </tr>
        <tr>
            <td>isset()</td>
            <td>Verifica se a variável existe e não é null</td>
            <td>isset($_POST['nome'])</td> <!-- Verifica se não é nulo (true/false) -->
        </tr>
        <tr>
            <td>empty()</td>
            <td>Verifica se a variável está vazia</td>
            <td>empty($_POST['email'])</td> <!-- Verifica se está vazio (true/false) -->
        </tr>
        <tr>
            <td>is_numeric()</td>
            <td>Verifica se é um número</td>
            <td>is_numeric($_POST['idade'])</td> <!-- Verifica se é numérico (true/false) -->
        </tr>
        <tr>
            <td>is_string()</td>
            <td>Verifica se é uma string</td>
            <td>is_string($_POST['nome'])</td> <!-- Verifica se é string (true/false) -->
        </tr>
        <tr>
            <td>filter_var()</td>
            <td>Valida ou sanitiza dados (função moderna e segura)</td>
            <td>filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)</td> <!-- Verifica o tipo da estrutura da variável - Nesse caso "FILTER_VALIDATE_EMAIL" se é um email (true/false) -->
        </tr>
        <tr>
            <td>strlen()</td>
            <td>Retorna o tamanho de uma string</td>
            <td>strlen($_POST['senha']) >= 6</td> <!-- Verifica tamanho de caracteres (true/false) -->
        </tr>
    </table>
    <br><hr><br>

    <h2>Exemplo: Validação Simples</h2>
    <form action="index.php" method="post">
        <label>Nome: </label>
        <input type="text" name="nome"><br><br>
        <label>Email: </label>
        <input type="text" name="email"><br><br>
        <label>Idade: </label>
        <input type="text" name="idade"><br>
        <button type="submit">Enviar</button>
    </form>

    <br>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Captura os dados
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $idade = $_POST["idade"];

            // Validação do nome
            if (empty($nome)) {
                echo "- O campo nome é obrigatório. <br>";
            } elseif (strlen($nome) < 3) {
                echo "- O nome deve ter pelo menos 3 caracteres. <br>";
            }

            // Validação do e-mail
            if (empty($email)) {
                echo "- O campo email é obrigatório. <br>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "- Formato de email inválido. <br>";
            }

            // Validação da idade
            if (empty($idade)) {
                echo "- O campo idade é obrigatório. <br>";
            } elseif (!is_numeric($idade)) {
                echo "- A idade deve ser um número. <br>";
            } elseif ($idade < 18) {
                echo "- Você deve ter pelo menos 18 anos. <br>";
            }
        }
    ?>

    <br>
    <hr>
    <br>

    <script> // Tag que abre possibilidade de código em JavaScript no HTML
        alert("Meu nome é Miguel"); // Exibe uma mensagem de alerta no navegador
    </script>

    <h2>Usando filter_var</h2>
    <?php
        $idade = "25";

        if (filter_var($idade, FILTER_VALIDATE_INT)) {
        echo "Idade válida!";
        } else {
        echo "Idade inválida!";
        }
    ?>
</body>
</html>