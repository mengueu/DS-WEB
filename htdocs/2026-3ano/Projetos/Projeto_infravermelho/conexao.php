<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$portaSerial = "\\\\.\\COM3"; // Ajustar porta do seu computador

exec("mode $portaSerial BAUD=9600 PARITY=n DATA=8 STOP=1 to=off dtr=off rts=off");

/*
exec(...): roda um programa ou instrução direto no CMD

mode: configurar dispositivos de hardware no windows

$portaSerial: Variável PHP que guarda o nome da porta

BAUD=9600: Velocidade da transmissão de dados

PARITY=n: Paridade desativada (None).

DATA=8: Tamanho do dado.

STOP=1: Bit de parada. Indica que há 1 bit no final de cada pacote para avisar que aquele dado terminou.

to=off: Desativa o Timeout (tempo limite de espera). Evita que o Windows desista de ler se o Arduino demorar a responder.

dtr=off: Desativa o pino Data Terminal Ready. Crucial aqui: impede que o Arduino reinicie (sofra reset) toda vez que o PHP abrir a porta.

rts=off: Desativa o pino Request to Send. Desliga o controle de fluxo por hardware, deixando a comunicação mais direta e simples.
*/

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