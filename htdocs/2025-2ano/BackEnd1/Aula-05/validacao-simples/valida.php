<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $idade = $_POST["idade"];

        if (empty($nome)) {
            echo "- O campo nome é obrigatório. <br>";
        } elseif (strlen($nome) < 3) {
             echo "- O nome deve ter pelo menos 3 caracteres. <br>";
        }

        if (empty($email)) {
            echo "- O campo email é obrigatório. <br>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "- Formato de email inválido. <br>";
        }

         if (empty($idade)) {
            echo "- O campo idade é obrigatório. <br>";
        } elseif (!is_numeric($idade)) {
            echo "- A idade deve ser um número. <br>";
        } elseif ($idade < 18) {
            echo "- Você deve ter pelo menos 18 anos. <br>";
        }
    }
?>
</body>
</html>


