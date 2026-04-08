<?php
    if (isset ($_GET['codigoautor'])) {
        $codigoautor = $_GET['codigoautor'];

        require_once '../conexaobiblioteca.php';

        $sql = "DELETE FROM autor WHERE codigoautor = $codigoautor";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: ../../autor.php");
        } else {
            echo "Erro ao deletar autor: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: ../../autor.php");
    }
?>