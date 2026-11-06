<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro_login'] = "Você precisa estar logado para acessar o sistema.";
    header("Location: login.php");
    exit;
}
?>