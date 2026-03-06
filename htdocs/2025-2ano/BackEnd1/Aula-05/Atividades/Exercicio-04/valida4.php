<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
        echo "Número limpo: " . $telefone;
    }
    ?>