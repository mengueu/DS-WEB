    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Captura os dados
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $idade = $_POST["idade"];

            // Validação do nome
            if (filter_var($nome, FILTER_SANITIZE_STRING)) {
                echo "- Nome OK!. <br>";
            }

            // Validação do e-mail
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "- Email OK!. <br>";
            }

            // Validação da idade
            if (filter_var($idade, FILTER_VALIDATE_INT)) {
                echo "- Idade OK!. <br>";
            }
        }
    ?>




