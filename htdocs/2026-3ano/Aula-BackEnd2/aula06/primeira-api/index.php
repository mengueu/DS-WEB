<?php

header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON
header('Access-Control-Allow-Origin: *'); // Permite requisições de qualquer origem (CORS)
header('Access-Control-Allow-Methods: GET, POST'); // Define os métodos HTTP permitidos

$method = $_SERVER['REQUEST_METHOD']; // Captura o método HTTP da requisição atual (GET, POST, etc.)
// echo $method; - Imprime o método (no caso GET)

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Extrai apenas o caminho da URL, ignorando query string

$path = trim($path, '/');// 'trim' limpa a string e o parâmetro '/' remove a barra inicial

$segments = explode('/', $path); // 'explode' remove o parâmetro '/' e toda vez que encontra uma barra, divide em segmentos (cada segmento é uma array)
// echo $segments[3]; - Exibe a 3° posição do array

$endpoint = $segments[4] ?? ''; // Pega o endpoint solicitado
/* Este comando: 
    $endpoint = $segments[4] ?? '';

   é a mesma coisa que:

    if ($endpoint == $segments[4]){
        $segments[4];
    } else{
        $endpoint[4] = '';
    }
*/

switch ($endpoint) {
    case 'hello':
        echo json_encode([
            'status' => 'success',
            'message' => 'Ola! A API esta funcionando.'
        ]);
        break;

    case 'produtos':
        echo json_encode([
            'status' => 'success',
            'nomeProduto' => 'Pao',
            'precoProduto' => 'R$12,90'
        ]);
        break;

    case 'echo':
        if ($method === 'POST') {
            // Lê e decodifica o JSON do corpo da requisição para um array PHP
            $input = json_decode(file_get_contents('php://input'), true); // json_decode = transforme em json
        } else {
            $input = "Metodo GET";
        }
        echo json_encode([
            'status' => 'success',
            'echo' => $input
        ]);
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Endpoint nao encontrado.'
        ]);
}

?>