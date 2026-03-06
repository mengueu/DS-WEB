<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);

        if (!empty($cidade) && !empty($nome)) {

            require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';

            $sql = "INSERT INTO editora (nomeeditora, cidadesede) VALUES ('$nome', '$cidade')";
            $resultado = mysqli_query($conexao, $sql);

            echo "Usuário cadastrado com sucesso!";
            header("Location: /biblioteca/editora.php");

        } else {
            echo "Por favor, preencha todos os campos corretamente.";
        }
    } 
?>