<?php
// Mini API de Produtos - Disciplina de Teste de Software
// Para rodar: php -S localhost:8000

header('Content-Type: application/json; charset=utf-8');

// Lista de produtos (fica na memória, não precisa de banco de dados)
$produtos = [
    ['id' => 1, 'nome' => 'Teclado', 'preco' => 150.00],
    ['id' => 2, 'nome' => 'Mouse',   'preco' => 80.00],
    ['id' => 3, 'nome' => 'Monitor', 'preco' => 900.00],
    ['id' => 4, 'nome' => 'Celular', 'preco' => 1500.00],
];

// Descobre qual endereço foi acessado (ex.: /status)
$rota = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($rota === '/status') {
    echo json_encode(['status' => 'ok']);
} elseif ($rota === '/produtos') {
    echo json_encode($produtos);
} else {
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada'], JSON_UNESCAPED_UNICODE);
}
