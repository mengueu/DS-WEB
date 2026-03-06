<?php
    if (isset ($_GET['idFilme'])) {
        $idFilme = $_GET['idFilme'];

        require_once 'conexao.php';

        $sql = "DELETE FROM filmes WHERE idFilme = $idFilme";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: index.php");
        } else {
            echo "Erro ao deletar aluno: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: index.php");
    }
?>