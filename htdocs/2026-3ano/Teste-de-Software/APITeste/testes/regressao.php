<?php
// TESTE DE REGRESSÃO
// Objetivo: depois de mudar o código, conferir se o que já funcionava continua igual.
//
// Como usar:
//   1) Com a API correta, salve a "foto" do comportamento atual:  php testes/regressao.php salvar
//   2) Altere o index.php (troque um preço, adicione um produto, renomeie um campo...)
//   3) Rode a comparação:                                           php testes/regressao.php

require __DIR__ . '/_ajuda.php';
exigir_servidor($base);

$arquivo = __DIR__ . '/baseline.json';
$rotas = ['/status', '/produtos'];

// Lê o estado atual da API
$atual = [];
foreach ($rotas as $rota) {
    $r = requisicao('GET', "$base$rota");
    $atual[$rota] = ['codigo' => $r['codigo'], 'corpo' => json_decode($r['corpo'], true)];
}

if (($argv[1] ?? '') === 'salvar') {
    file_put_contents($arquivo, json_encode($atual, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Comportamento atual salvo em testes/baseline.json.\n";
    echo "Agora altere o index.php e rode novamente: php testes/regressao.php\n";
    exit;
}

if (!is_file($arquivo)) {
    echo "Ainda não existe uma versão salva. Rode primeiro: php testes/regressao.php salvar\n";
    exit(1);
}

$antes = json_decode(file_get_contents($arquivo), true);
echo "Teste de regressão em $base (comparando com a versão salva)\n\n";
foreach ($rotas as $rota) {
    $igual = $antes[$rota] === $atual[$rota];
    verificar("$rota continua igual ao que foi salvo", $igual);
    if (!$igual) {
        echo '         antes: ' . json_encode($antes[$rota], JSON_UNESCAPED_UNICODE) . "\n";
        echo '         agora: ' . json_encode($atual[$rota], JSON_UNESCAPED_UNICODE) . "\n";
    }
}
resumo();
