<?php
// TESTE DE ESTRESSE
// Objetivo: mandar cada vez mais requisições AO MESMO TEMPO e ver como a API reage.
// Precisa da extensão curl do PHP (confira com: php -m).
// Como rodar: php testes/estresse.php

require __DIR__ . '/_ajuda.php';
if (!function_exists('curl_multi_init')) {
    echo "Este teste precisa da extensão curl do PHP (veja o README).\n";
    exit(1);
}
exigir_servidor($base);

$niveis = [100, 500, 1000];   // quantidade de requisições simultâneas (você pode mudar)
echo "Teste de estresse em $base/produtos\n\n";
printf("%-14s %9s %8s %12s\n", 'Simultâneas', 'Sucesso', 'Falhas', 'Tempo total');

foreach ($niveis as $n) {
    $multi = curl_multi_init();
    $conexoes = [];
    for ($i = 0; $i < $n; $i++) {
        $ch = curl_init("$base/produtos");
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 5]);
        curl_multi_add_handle($multi, $ch);
        $conexoes[] = $ch;
    }

    $inicio = microtime(true);
    do {
        curl_multi_exec($multi, $ativas);
        if ($ativas) {
            curl_multi_select($multi, 0.1);
        }
    } while ($ativas);
    $tempo = microtime(true) - $inicio;

    $sucesso = 0;
    foreach ($conexoes as $ch) {
        if (curl_getinfo($ch, CURLINFO_RESPONSE_CODE) === 200) {
            $sucesso++;
        }
        curl_multi_remove_handle($multi, $ch);
        curl_close($ch);
    }
    curl_multi_close($multi);
    printf("%-14d %9d %8d %10.2f s\n", $n, $sucesso, $n - $sucesso, $tempo);
}

echo "\nDepois da carga:\n";
verificar('a API continua respondendo ao /status', requisicao('GET', "$base/status")['codigo'] === 200);
resumo();
