<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$portaSerial = "\\\\.\\COM7"; // Mantém a sintaxe que funcionou para você

exec("mode $portaSerial BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");

$fp = fopen($portaSerial, "r+");
$status = "1"; // Padrão: desligado

if ($fp) {
    // Define um tempo limite bem curto para a leitura
    stream_set_timeout($fp, 0, 20000); // 20 milissegundos
    
    // LER VÁRIAS LINHAS PARA PEGAR O DADO MAIS RECENTE
    // Isso limpa o "lixo" acumulado na linha e pega o valor atual real
    for ($i = 0; $i < 5; $i++) {
        $linha = trim(fgets($fp));
        if ($linha === "0" || $linha === "1") {
            $status = $linha; // Atualiza com o último valor válido encontrado
        }
    }
    
    fclose($fp);
}

// Envia o valor final filtrado e sem oscilações para o JavaScript
echo json_encode(["valorBruto" => intval($status)]);
?>