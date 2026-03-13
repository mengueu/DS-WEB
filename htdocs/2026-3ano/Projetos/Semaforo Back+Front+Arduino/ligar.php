<?php
require "arduino.php";

$arduino = new Arduino("COM3");

if (isset($_POST["modo"])) {
    $modo = $_POST["modo"];

    if ($modo == "iniciar") {
        $arduino->iniciar();
    }
    if ($modo == "lento") {
        $arduino->devagar();
    }
    if ($modo == "medio") {
        $arduino->moderado();
    }
    if ($modo == "rapido") {
        $arduino->rapido();
    }
    if ($modo == "parar") {
        $arduino->parar();
    }
    echo "Comando recebido: " . $modo;
} 
else {
    echo "Nenhum comando recebido";
}
?>