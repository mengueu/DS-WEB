<?php
    if (isset ($_GET['codigoaluno'])) {
        $codigoaluno = $_GET['codigoaluno'];

        require_once '../conexaobiblioteca.php';

        $sql = "DELETE FROM aluno WHERE codigoaluno = $codigoaluno";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: ../../aluno.php");
        } else {
            echo "Erro ao deletar aluno: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: ../../aluno.php");
    }
?>