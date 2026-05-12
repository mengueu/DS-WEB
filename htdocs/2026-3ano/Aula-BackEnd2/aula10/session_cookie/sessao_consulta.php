<?php
session_start();

echo $_SESSION["favcolor"];
echo "<br>";
echo $_SESSION["favanimal"];
echo "<br>";

    if(isset($_SESSION["login"])){
        echo "Usuário logado";
    } else {
        echo "Realize o login";
    }
    echo "<br>";

    session_destroy();

    echo $_SESSION["favcolor"];
?>