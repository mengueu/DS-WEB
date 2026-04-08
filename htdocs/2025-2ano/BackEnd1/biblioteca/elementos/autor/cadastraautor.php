<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $nacionalidade = filter_input(INPUT_POST, 'nacionalidade', FILTER_SANITIZE_STRING);

        if (!empty($nacionalidade) && !empty($nome)) {

            require_once '../conexaobiblioteca.php';

            $sql = "INSERT INTO autor (nomeautor, nacionalidadeautor) VALUES ('$nome', '$nacionalidade')";
            $resultado = mysqli_query($conexao, $sql);

            echo "Usuário cadastrado com sucesso!";
            header("Location: ../../autor.php");

        } else {
            echo "Por favor, preencha todos os campos corretamente.";
        }
    } 
?>