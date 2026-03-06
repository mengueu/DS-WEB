<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 3 - PHP</title>
</head>
<body>
    <h1>Tipos de Dados:</h1>

    <?php
        $valorInteiro = 10; // Inteiro
        $valorFloat = 10.5; // Float
        $valorString = "Olá, Mundo!"; // String
        $valorBoolean = true; // Boolean
        $valorArray = array("Maçã", "Banana", "Laranja"); // Array
        $valorNull = null; // Null

        // Exibir os tipos de dados usando var_dump()
        echo "<b>Valor Inteiro: </b>", var_dump($valorInteiro); echo "<br>";
        echo "<b>Valor Float: </b>", var_dump($valorFloat); echo "<br>";
        echo "<b>Valor String: </b>"; var_dump($valorString); echo "<br>";
        echo "<b>Valor Boolean: </b>", var_dump($valorBoolean); echo "<br>";
        echo "<b>Valor Array: </b>", var_dump($valorArray); echo "<br>";
        echo "<b>Valor Null: </b>", var_dump($valorNull); 
    ?>
    <h1>Conversão de Tipos de Dados:</h1>
    <?php
        // Adaptando tipos de dados com o Tipo Juggling
        $valor = 10;
        $expressão = "15";
        $total = $valor + $expressão; // O PHP converte automaticamente a string "15" para o inteiro 15
        echo "- <b>Resultado da soma com Tipo Juggling: </b>" . $total; // Exibe 25

        $valor1 = 3;
        $expressao2 = "10 Laranjas";
        $total2 = $valor1 + $expressao2;
        echo "<br>- <b>Resultado da soma com Tipo Juggling 2: </b>" . $total2; // Exibe 13

        $valor3 = 1.0;
        if ($valor3) echo "<br> - Acho que entendeu verdadeiro"; // Exibe a mensagem porque 1.0 é considerado verdadeiro
    ?>
    <br>
    <h1>Declaração de variáveis</h1>
    <?php
        echo "<h3>Variável Local:</h3>";
        //Variáveis Locais: funcionam apenas dentro do escopo da função
        function minhaFuncao() {
            $variavelLocal = "- Eu sou uma variável local!";
            echo $variavelLocal;
        }
        echo minhaFuncao();

        echo "<br>";

        echo "<h3>Variável Global:</h3>";
        //Variáveis Globais: funcionam em todo o escopo do script
        $variavelGlobal = "- Eu sou uma variável global!";
        function minhaOutraFuncao() {
            global $variavelGlobal;
            echo $variavelGlobal;
        }
        echo minhaOutraFuncao();

        echo "<br>";

        echo "<h3>Variável Estática:</h3>";
        //Variáveis Estáticas: mantêm seu valor entre chamadas de função
        function minhaFuncaoEstatica() {
            static $contador = 0;
            $contador++;
            echo "- Contador Estático: " . $contador . "<br>";
        }
        echo minhaFuncaoEstatica();
        echo minhaFuncaoEstatica();
        echo minhaFuncaoEstatica();

        echo "<br>";

        echo "<h3>Variável Super Global</h3>";
        //Variáveis Superglobais: arrays pré-definidos que estão disponíveis em todos os escopos
        foreach ($_SERVER as $var => $valor) {
            echo $var . ": " . $valor . "<br>";
        }
    ?>
    <br>
    <h1>Constantes</h1>
    <?php
        // Definindo uma constante
        define("PI", 3.14159); // Primeiro parâmetro é o nome da constante, segundo é o valor
        define("aula", "'Aula de PHP - Constantes'");
        echo "Em nossa última aula de PHP: " . aula, ", vimos que a constante PI tem o valor de: " . PI . "<br>";
    ?>
</body>
</html>