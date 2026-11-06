<?php
// helpers/logger.php
function registrarLog($mensagem) {
    $caminhoLog = __DIR__ . '/../logs.txt';
    $dataHora = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $linha = "[$dataHora] [IP: $ip] - $mensagem" . PHP_EOL;
    file_put_contents($caminhoLog, $linha, FILE_APPEND | LOCK_EX);
}
?>