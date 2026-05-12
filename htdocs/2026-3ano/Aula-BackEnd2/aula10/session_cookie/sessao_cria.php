<?php
// Inicio da Sessão
session_start();

$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";

$_SESSION["login"] = true;

echo "Variaveis de sessão foram definidas. ";

echo "<br>(Olhar os códigos)";

// unset($_SESSION["favcolor"]);

?>
