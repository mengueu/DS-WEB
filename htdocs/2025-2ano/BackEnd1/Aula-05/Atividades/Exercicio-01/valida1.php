<meta charset="UTF-8">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (empty($nome)) {
        echo "O campo nome não pode estar vazio.";
    } elseif ($email === false) {
        echo "O email fornecido não é válido.";
    } else {
        echo "Bem-vindo, " . htmlspecialchars($nome) . "!";
    }
}
?>