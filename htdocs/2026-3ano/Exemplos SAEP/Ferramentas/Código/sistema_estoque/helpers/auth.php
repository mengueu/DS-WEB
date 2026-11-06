<?php
// helpers/auth.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro_login'] = "Tem de estar autenticado para aceder ao sistema.";
    header("Location: login.php");
    exit;
}
?>