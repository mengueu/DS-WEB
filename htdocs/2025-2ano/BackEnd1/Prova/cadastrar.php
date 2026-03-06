<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
        $sinopse = filter_input(INPUT_POST, 'sinopse', FILTER_SANITIZE_STRING);
        $ano_lancamento = filter_input(INPUT_POST, 'ano_lancamento', FILTER_VALIDATE_INT);
        $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);

        if (!empty($sinopse) && !empty($titulo) && !empty($ano_lancamento) && !empty($genero)) {

            require_once 'conexao.php';

            $sql = "INSERT INTO filmes (titulo, sinopse, ano_lancamento, genero) VALUES ('$titulo', '$sinopse', '$ano_lancamento', '$genero')";
            $resultado = mysqli_query($conexao, $sql);
            header("Location: index.php");

        } else {
            echo "Por favor, preencha todos os campos corretamente.";
        }
    } 
?>