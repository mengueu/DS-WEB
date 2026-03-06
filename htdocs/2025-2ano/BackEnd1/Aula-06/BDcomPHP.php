<meta charset="UTF-8">
<?php
    require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados
    echo "<h2>Consulta ao BD com PHP</h2>";

    // Realiza uma consulta SQL para selecionar todos os usuários
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexao, $sql); // Executa a consulta SQL
    $linha = mysqli_fetch_assoc($resultado); // Busca a primeira linha do resultado como um array associativo
    echo "Nome do primeiro usuário: " . $linha['nome'];

    // Percorrendo apenas 1 linha da consulta
    echo "<h2>Percorrendo apenas 1 linha da consulta</h2>";

    $resultado = mysqli_query($conexao, $sql); // Executa a consulta SQL novamente para "Zerar o ponteiro" da consulta

    if (mysqli_num_rows($resultado) > 0) { // Verifica se há resultados
        $linha = mysqli_fetch_assoc($resultado); // Busca a próxima linha do resultado
        echo "Usuário da 1° linha: " . $linha['nome'];
    } else {
        echo "<br>Nenhum usuário encontrado.";
    }

    // Fazendo todos os resultados da consulta
    echo "<h2>Percorrendo todas as linhas da consulta</h2>";
    $resultado = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) { // Loop através de todas as linhas do resultado
            echo  "Usuário " . $linha['id'] . ": " . $linha['nome'] . "<br>";
        }
    } else {
        echo "<br>Nenhum usuário encontrado.";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuários</title>
</head>
<body>
    
</body>
</html>