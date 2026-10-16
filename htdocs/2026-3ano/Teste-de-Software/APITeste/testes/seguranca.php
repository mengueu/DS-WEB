<?php
// TESTE DE SEGURANÇA (básico)
// Objetivo: procurar proteções que estão faltando. Aqui, "FALHOU" significa que
// encontramos um problema de segurança na API (o que é um bom resultado para o testador!).
// Use apenas na sua própria API de estudo. Como rodar: php testes/seguranca.php

require __DIR__ . '/_ajuda.php';
exigir_servidor($base);
echo "Teste de segurança em $base\n\n";

echo "Métodos HTTP (a API deveria aceitar só GET e responder 405 para os outros)\n";
foreach (['POST', 'PUT', 'DELETE'] as $metodo) {
    $r = requisicao($metodo, "$base/produtos");
    verificar("$metodo /produtos é recusado (405)", $r['codigo'] === 405, "obtido: {$r['codigo']}");
}
$r = requisicao('POST', "$base/status");
verificar('POST /status é recusado (405)', $r['codigo'] === 405, "obtido: {$r['codigo']}");

echo "\nInformações expostas\n";
$r = requisicao('GET', "$base/status");
verificar('a resposta não revela a tecnologia (cabeçalho X-Powered-By)', !isset($r['cabecalhos']['x-powered-by']),
    'cabeçalho encontrado: X-Powered-By: ' . ($r['cabecalhos']['x-powered-by'] ?? ''));

$r = requisicao('GET', "$base/rota-inexistente");
verificar('o erro 404 não mostra caminhos nem erros do PHP',
    !preg_match('/Warning|Notice|Fatal|Stack trace|\/home|[A-Z]:\\\\/', $r['corpo']));

echo "\nArquivos do projeto\n";
foreach (['/README.md'] as $arquivo) {
    $r = requisicao('GET', "$base$arquivo");
    verificar("$arquivo não pode ser baixado pela internet", $r['codigo'] !== 200, "a API devolveu o arquivo (código {$r['codigo']})");
}
$r = requisicao('GET', "$base/index.php");
verificar('o código-fonte do index.php não é exibido', !str_contains($r['corpo'], '<?php'));

resumo();