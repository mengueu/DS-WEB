<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Adição</title>
</head>
<body>
    <h1>Calculadora Adição</h1>
    <form action="" method="post">
        <label for="num1">Número 1:</label>
        <input type="number" id="num1" name="num1" required>
        <br><br>
        <label for="num2">Número 2:</label>
        <input type="number" id="num2" name="num2" required>
        <br><br>
        <input type="submit" value="Calcular">
        <br><br>

        <?php
            var_dump($_POST); // Exibe o conteúdo do array $_POST para depuração
            echo $_POST['num1'] + $_POST['num2'];

            echo "<br> <br>";

            if(isset($_POST['num1'])){ // Verifica se 'num1' está definido na variável $_POST
                echo "Está criado o número 1: " . $_POST['num1'];
            }
            echo "<br>";
            if(isset($_POST['num2'])){
                echo "Está criado o número 2: " . $_POST['num2'];
            }
        ?>
    </form>
</body>
</html>