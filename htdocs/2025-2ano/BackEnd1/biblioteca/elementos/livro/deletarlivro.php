<?php
    if (isset ($_GET['codigolivro'])) {
        $codigolivro = $_GET['codigolivro'];

        require_once '../conexaobiblioteca.php';

        $sql = "DELETE FROM livro WHERE codigolivro = $codigolivro";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: ../../livro.php");
        } else {
            echo "Erro ao deletar livro: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: ../../livro.php");
    }
?>