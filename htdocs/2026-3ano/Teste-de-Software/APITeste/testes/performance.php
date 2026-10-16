<?php
// TESTE DE PERFORMANCE
// Objetivo: medir o tempo de resposta com um usuário por vez e comparar com um limite.
// Como rodar: php testes/performance.php

require __DIR__ . '/_ajuda.php';
exigir_servidor($base);

$limite_ms = 100;   // tempo médio máximo aceitável (você pode mudar)
$repeticoes = 20;

echo "Teste de performance em $base ($repeticoes requisições por rota)\n\n";
foreach (['/status', '/produtos'] as $rota) {
    $tempos = [];
    for ($i = 0; $i < $repeticoes; $i++) {
        $tempos[] = requisicao('GET', "$base$rota")['tempo'];
    }
    $media = array_sum($tempos) / count($tempos);
    $maior = max($tempos);
    printf("%-10s média: %6.1f ms | maior: %6.1f ms | limite: %d ms\n", $rota, $media, $maior, $limite_ms);
    verificar("$rota: tempo médio abaixo de $limite_ms ms", $media < $limite_ms);
}
resumo();
