<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 1 - PHP</title>
</head>
<body>
    <h1>Aula 1 de PHP</h1><br>
    <h2>Printando textos:</h2>
    
    <!-- Mesclando HTML com PHP -->
    <?php // Tag de abertura padrão
    
    // Comentário
    /* Comentário de múltiplas linhas */

    // Funções básicas de saída:
        print "print: Olá, Mundo! Esta é a minha primeira página em PHP.<br>"; // print: saída simples

        echo "echo: Olá, Mundo! Esta é a minha primeira página em PHP.<br>"; // echo: saída simples, pode receber múltiplos argumentos

        printf("Ainda tenho %d litros de gasolina.<br>",23); // printf: Permite utilizar texto estático e dinâmico armazenado dentro de variáveis.

        $valor = 1000; // $ = Declaração de variável

        printf("O valor do produto é R$ %.2f<br>", $valor);
    
    // %b - O argumento é tratado com um inteiro, e mostrado como um binário.
    // %c - O argumento é tratado como um inteiro, e mostrado como o caractere ASCII correspondente.
    // %d - O argumento é tratado como um inteiro, e mostrado como um número decimal com sinal.
    // %e - O argumento é tratado como notação científica.
    // %u - O argumento é tratado com um inteiro, e mostrado como um número decimal sem sinal.
    // %f ou %F - O argumento é tratado como um float, e mostrado como um número de ponto flutuante.
    // %o - O argumento é tratado com um inteiro, e mostrado como um número octal.
    // %s - O argumento é tratado e mostrado como uma string.
    // %x - O argumento é tratado como um inteiro, e mostrado como um número hexadecimal (com as letras minúsculas).
    // %X - O argumento é tratado como um inteiro, e mostrado como um número hexadecimal (com as letras maiúsculas).
    ?>
    <h2>Tipos de argumentos:</h2>
    <?php
        $num = "01";
        printf("Número binário: %b<br>", $num); echo "<br>";
        printf("Caractere ASCII: %c<br>", $num); echo "<br>";
        printf("Número decimal com sinal: %d<br>", $num); echo "<br>";
        printf("Notação científica: %e<br>", $num); echo "<br>";
        printf("Número decimal sem sinal: %u<br>", $num); echo "<br>";
        printf("Número de ponto flutuante: %f<br>", $num); echo "<br>";
        printf("Número octal: %o<br>", $num); echo "<br>";
        printf("String: %s<br>", $num); echo "<br>";
        printf("Número hexadecimal (minúsculas): %x<br>", $num); echo "<br>";
        printf("Número hexadecimal (maiúsculas): %X<br>", $num);
    ?>
</body>
</html>