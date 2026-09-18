<?php
    require "led.php";
    $led = new Lampada("COM16");
    $led->piscar();
?>