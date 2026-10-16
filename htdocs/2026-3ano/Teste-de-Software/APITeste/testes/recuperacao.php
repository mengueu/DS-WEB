<?php
// TESTE DE RECUPERAÇÃO
// Objetivo: derrubar a API de propósito e verificar se ela volta a funcionar normalmente.
// Este teste é guiado: você derruba e sobe o servidor quando o script pedir.
// Como rodar: php testes/recuperacao.php

require __DIR__ . '/_ajuda.php';
exigir_servidor($base);
echo "Teste de recuperação em $base\n\n";

echo "Passo 1: antes da falha\n";
$antes = requisicao('GET', "$base/produtos");
verificar('a API está respondendo normalmente', $antes['codigo'] === 200);

echo "\nPasso 2: derrube a API\n";
echo "Vá ao terminal onde o servidor está rodando e aperte Ctrl+C.\n";
echo "Depois volte aqui e aperte ENTER... ";
fgets(STDIN);
$r = requisicao('GET', "$base/status");
verificar('com o servidor parado, a API não responde', $r['codigo'] === 0, "a API ainda respondeu com código {$r['codigo']}");

echo "\nPasso 3: suba a API novamente\n";
echo "No terminal do servidor, execute de novo: php -S localhost:8000\n";
echo "Assim que o comando for executado, aperte ENTER aqui... ";
fgets(STDIN);

$inicio = microtime(true);
do {
    $r = requisicao('GET', "$base/status");
    if ($r['codigo'] !== 200) {
        usleep(500000);
    }
} while ($r['codigo'] !== 200 && microtime(true) - $inicio < 15);
$tempo = microtime(true) - $inicio;

echo "\nPasso 4: depois da recuperação\n";
verificar('a API voltou a responder', $r['codigo'] === 200);
printf("         tempo até voltar a responder: %.1f s\n", $tempo);
$depois = requisicao('GET', "$base/produtos");
verificar('/produtos retorna o mesmo conteúdo de antes da falha', $depois['corpo'] === $antes['corpo']);
resumo();
