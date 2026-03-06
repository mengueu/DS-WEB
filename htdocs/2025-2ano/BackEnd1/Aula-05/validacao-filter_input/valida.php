<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);
        
        if (!$nome) {
            echo "Nome inválido.<br>";
        }else{
            echo "Nome válido.<br>";
        }
        if (!$email) {
            echo "Email inválido.<br>";
        } else{
            echo "Email válido.<br>";
        }
        if (!$idade) {
            echo "Idade inválida.<br>";
        } else{
            echo "Idade válida.<br>";
        }
        if ($nome && $email && $idade) {
            echo "Todos os dados estão válidos!";
        }
    ?> 
</body>
</html>


