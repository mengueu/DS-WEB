<?php
    if (isset ($_GET['codigoeditora'])) {
        $codigoeditora = $_GET['codigoeditora'];

        require_once '../conexaobiblioteca.php';

        $sql = "DELETE FROM editora WHERE codigoeditora = $codigoeditora";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: ../../editora.php");
        } else {
            echo "Erro ao deletar editora: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: ../../editora.php");
    }
?>