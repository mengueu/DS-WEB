<?php
require "arduino.php";

$arduino = new Arduino("COM4");

if (isset($_POST["modo"])) {
    $modo = $_POST["modo"];

    if ($modo == "lento") {
        $arduino->lento();
    }
    else if ($modo == "moderado") {
        $arduino->moderado();
    }
    else if ($modo == "rapido") {
        $arduino->rapido();
    }
    else if ($modo == "parar") {
        $arduino->parar();
    }
}
?>