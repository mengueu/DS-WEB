<?php
// Salvar um cookie (válido por 7 dias)
setcookie("usuario", "João", time() + (7 * 24 * 60 * 60), "/");

?>