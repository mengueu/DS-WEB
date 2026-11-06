<?php
session_start();
require_once 'helpers/logger.php';
if (isset($_SESSION['usuario_nome'])) {
    registrarLog("LOGOUT: Usuário {$_SESSION['usuario_nome']} saiu do sistema.");
}
session_destroy();
header("Location: login.php");
exit;
?>