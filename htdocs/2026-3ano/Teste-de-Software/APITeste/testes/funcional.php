<?php
// TESTE FUNCIONAL
// Objetivo: verificar se a API faz o que deveria fazer.
// Como rodar (na pasta do projeto): php testes/funcional.php

require __DIR__ . '/_ajuda.php';
exigir_servidor($base);
echo "Teste funcional em $base\n\n";

echo "GET /status\n";
$r = requisicao('GET', "$base/status");
verificar('retorna código 200', $r['codigo'] === 200, "obtido: {$r['codigo']}");
verificar('corpo é {"status":"ok"}', json_decode($r['corpo'], true) === ['status' => 'ok'], "obtido: {$r['corpo']}");
verificar('Content-Type é JSON', str_contains($r['cabecalhos']['content-type'] ?? '', 'application/json'));

echo "\nGET /produtos\n";
$r = requisicao('GET', "$base/produtos");
$lista = json_decode($r['corpo'], true);
verificar('retorna código 200', $r['codigo'] === 200, "obtido: {$r['codigo']}");
verificar('retorna uma lista com 3 produtos', is_array($lista) && count($lista) === 3, 'quantidade obtida: ' . (is_array($lista) ? count($lista) : 'não é lista'));
foreach ($lista ?? [] as $i => $produto) {
    $completo = isset($produto['id'], $produto['nome'], $produto['preco']);
    verificar('produto ' . ($i + 1) . ' tem id, nome e preco', $completo);
    verificar('produto ' . ($i + 1) . ' tem preço maior que zero', ($produto['preco'] ?? 0) > 0);
}

echo "\nRota inexistente\n";
$r = requisicao('GET', "$base/rota-que-nao-existe");
verificar('retorna código 404', $r['codigo'] === 404, "obtido: {$r['codigo']}");
verificar('corpo tem a chave "erro"', isset(json_decode($r['corpo'], true)['erro']));

echo "\nCasos de borda\n";
$r = requisicao('GET', "$base/produtos?qualquer=coisa");
verificar('/produtos com parâmetro extra continua retornando 200', $r['codigo'] === 200, "obtido: {$r['codigo']}");

resumo();
