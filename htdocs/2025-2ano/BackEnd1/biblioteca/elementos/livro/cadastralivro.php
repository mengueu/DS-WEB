<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);

        if (!empty($ano) && !empty($titulo)) {

            require_once '../conexaobiblioteca.php';

            $sql = "INSERT INTO livro (titulo, anopublicacao) VALUES ('$titulo', '$ano')";
            $resultado = mysqli_query($conexao, $sql);

            echo "Usuário cadastrado com sucesso!";
            header("Location: ../../livro.php");

        } else {
            echo "Por favor, preencha todos os campos corretamente.";
        }
    } 
?>