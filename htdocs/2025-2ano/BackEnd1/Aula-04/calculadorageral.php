<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Geral</title>
</head>
<body>
    <h1>Calculadora Geral</h1>
    <form action="" method="post">

        <label for="valor1">Valor:</label>
        <input type="number" id="valor1" name="valor1" required>
        <br><br>
        
        <label for="operacao">Operação:</label>
        <select id="operacao" name="operacao" required>
            <option value="+">Adição</option>
            <option value="-">Subtração</option>
            <option value="*">Multiplicação</option>
            <option value="/">Divisão</option>
        </select>
        <br><br>

        <label for="valor2">Valor 2:</label>
        <input type="number" id="valor2" name="valor2" required>
        <br><br>

        <input type="submit" value="Calcular">
    </form>
    <?php
        if (isset ($_POST['valor1']) && isset($_POST['valor1'])){ // Verifica se os dados foram enviados pelo formulário

            $valor1 = ($_POST['valor1']);
            $operacao = ($_POST['operacao']);
            $valor2 = ($_POST['valor2']);

            switch ($operacao) {
                case "+":
                    $resultado = ($valor1 + $valor2);
                    echo "Resultado: ", $resultado;
                    break;
                case "-":
                    $resultado = ($valor1 - $valor2);
                    echo "Resultado: ", $resultado;
                        break;
                case "*":
                    $resultado = ($valor1 * $valor2);
                    echo "Resultado: ", $resultado;
                        break;
                case "/":
                    if($valor2 != 0){
                        $resultado = ($valor1 / $valor2);
                        echo "Resultado: ", $resultado;
                    } else {
                        echo "Erro: Divisão por zero não é permitida.";
                    }
                    break;
            }
        }        
    ?>
</body>
</html>