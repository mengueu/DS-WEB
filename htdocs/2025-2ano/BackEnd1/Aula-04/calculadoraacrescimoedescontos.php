<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Acréscimo e Descontos</title>
</head>
<body>
    <h1>Calculadora de Acréscimo e Descontos</h1>
    <form action="" method="post">

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" required>
        <br><br>
        
        <label for="opcao">Opção:</label>
        <select id="opcao" name="opcao" required>
            <option value="+">Acréscimo</option>
            <option value="-">Desconto</option>
        </select>
        <br><br>

        <label for="porcentagem">Porcentagem:</label>
        <input type="number" id="porcentagem" name="porcentagem" required>
        <br><br>

        <input type="submit" value="Calcular">
    </form>
    <?php
        if (isset ($_POST['valor']) && isset($_POST['valor'])){ // Verifica se os dados foram enviados pelo formulário

            $valor = ($_POST['valor']);
            $operacao = ($_POST['opcao']);
            $porcentagem = ($_POST['porcentagem']);

            switch ($operacao) {
                case "+":
                    $resultado = ($valor + ($valor*($porcentagem/100)));
                    echo "Resultado: ", $resultado;
                    break;
                case "-":
                    $resultado = ($valor - ($valor*($porcentagem/100)));
                    echo "Resultado: ", $resultado;
                        break;
            }
        }        
    ?>
</body>
</html>