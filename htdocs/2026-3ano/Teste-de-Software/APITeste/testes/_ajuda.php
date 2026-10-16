<?php
// Funções de apoio usadas pelos testes. Você não precisa mexer neste arquivo.

// Endereços da API: qualquer argumento que comece com "http" (padrão: porta 8000)
$urls = array_values(array_filter($argv, fn($a) => str_starts_with($a, 'http')));
$base = rtrim($urls[0] ?? 'http://localhost:8000', '/');

$total = 0;
$falhas = 0;

// Faz uma requisição e devolve: codigo, corpo, cabecalhos e tempo (em ms)
function requisicao(string $metodo, string $url): array
{
    $contexto = stream_context_create(['http' => [
        'method'        => $metodo,
        'ignore_errors' => true,   // não dar erro em respostas 404, 405...
        'timeout'       => 5,
    ]]);
    $inicio = hrtime(true);
    $corpo = @file_get_contents($url, false, $contexto);
    $ms = (hrtime(true) - $inicio) / 1e6;

    if ($corpo === false) {        // servidor desligado ou sem resposta
        return ['codigo' => 0, 'corpo' => '', 'cabecalhos' => [], 'tempo' => $ms];
    }
    preg_match('#HTTP/\S+ (\d+)#', $http_response_header[0], $m);
    $cabecalhos = [];
    foreach (array_slice($http_response_header, 1) as $linha) {
        if (str_contains($linha, ':')) {
            [$nome, $valor] = explode(':', $linha, 2);
            $cabecalhos[strtolower(trim($nome))] = trim($valor);
        }
    }
    return ['codigo' => (int) $m[1], 'corpo' => $corpo, 'cabecalhos' => $cabecalhos, 'tempo' => $ms];
}

// Para o teste com uma mensagem clara se a API não estiver no ar
function exigir_servidor(string $url): void
{
    if (requisicao('GET', "$url/status")['codigo'] === 0) {
        echo "A API não está respondendo em $url\n";
        echo "Abra outro terminal na pasta do index.php e execute: php -S localhost:8000\n";
        exit(1);
    }
}

// Registra o resultado de uma verificação
function verificar(string $nome, bool $ok, string $detalhe = ''): void
{
    global $total, $falhas;
    $total++;
    if (!$ok) {
        $falhas++;
    }
    echo ($ok ? '[PASSOU] ' : '[FALHOU] ') . $nome . "\n";
    if (!$ok && $detalhe !== '') {
        echo "         $detalhe\n";
    }
}

function resumo(): void
{
    global $total, $falhas;
    echo "\nResultado: " . ($total - $falhas) . " de $total verificações passaram.\n";
}
