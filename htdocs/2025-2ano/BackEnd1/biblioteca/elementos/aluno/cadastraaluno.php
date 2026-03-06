<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_VALIDATE_INT);

        if (!empty($email) && !empty($nome) && !empty($telefone)) {

            require_once 'C:\USBWebserver-2ano\USBWebserver v8.6\root\biblioteca\elementos\conexaobiblioteca.php';

            $sql = "INSERT INTO aluno (nomealuno, emailaluno, telefonealuno) VALUES ('$nome', '$email', '$telefone')";
            $resultado = mysqli_query($conexao, $sql);

            echo "Usuário cadastrado com sucesso!";
            header("Location: /biblioteca/aluno.php");

        } else {
            echo "Por favor, preencha todos os campos corretamente.";
        }
    } 
?>