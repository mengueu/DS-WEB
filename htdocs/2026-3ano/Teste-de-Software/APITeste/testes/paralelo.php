<?php
// TESTE PARALELO
// Objetivo: comparar a versão ANTIGA e a versão NOVA da API, com as mesmas requisições.
//
// Preparação:
//   1) Copie a pasta do projeto para outro lugar (ex.: mini-api-v2) e altere algo no index.php.
//   2) Rode a versão antiga na porta 8000 e a nova na porta 8001:
//        php -S localhost:8000        (na pasta original)
//        php -S localhost:8001        (na pasta copiada)
//   3) Rode: php testes/paralelo.php
// Para usar outras portas: php testes/paralelo.php http://localhost:8000 http://localhost:8002

require __DIR__ . '/_ajuda.php';
$antiga = rtrim($urls[0] ?? 'http://localhost:8000', '/');
$nova   = rtrim($urls[1] ?? 'http://localhost:8001', '/');
exigir_servidor($antiga);
exigir_servidor($nova);

echo "Teste paralelo\n  versão antiga: $antiga\n  versão nova:   $nova\n\n";
foreach (['/status', '/produtos', '/rota-inexistente'] as $rota) {
    $a = requisicao('GET', "$antiga$rota");
    $n = requisicao('GET', "$nova$rota");
    $igual = $a['codigo'] === $n['codigo'] && json_decode($a['corpo'], true) === json_decode($n['corpo'], true);
    verificar("$rota: as duas versões respondem igual", $igual);
    if (!$igual) {
        echo "         antiga: código {$a['codigo']} | " . trim(preg_replace('/\s+/', ' ', $a['corpo'])) . "\n";
        echo "         nova:   código {$n['codigo']} | " . trim(preg_replace('/\s+/', ' ', $n['corpo'])) . "\n";
    }
}
resumo();
echo "Cada diferença é uma melhoria intencional ou um defeito? Discuta com a turma.\n";
