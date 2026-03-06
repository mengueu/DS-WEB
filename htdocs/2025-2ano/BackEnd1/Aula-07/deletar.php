<?php
    if (isset ($_GET['id'])) {
        $idusuario = $_GET['id'];

        require_once 'conexao.php';

        $sql = "DELETE FROM usuarios WHERE id = $idusuario";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            header("Location: exemplopratico.php");
        } else {
            echo "Erro ao deletar usuário: " . mysqli_error($conexao);
            exit;
        }
    } else {
        header("Location: exemplopratico.php");
    }
?>