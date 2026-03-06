<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);

        if (!($idade >= 18)) {
            echo "Apenas maiores de idade podem prosseguir.";
        } else {
            echo "Idade válida!";
        }
    }
?>