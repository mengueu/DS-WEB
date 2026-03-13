<?php
$arquivo = "estado.txt";
if(file_exists($arquivo)){
    echo trim(file_get_contents($arquivo)); // "verde", "amarelo", "vermelho"
} else {
    echo "amarelo"; // valor padrão
}
?>