<?php
require_once 'database.php';
$database = new Database();

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
$segments = explode('/', $path);

if (isset($segments[5])) {
    $id = $segments[5];
} else {
    $id = null;
}

switch($method){

    case 'GET':
        $resultado = $database->executeQuery('SELECT * FROM produtos');
        $produtos = $resultado->fetchAll();

        echo json_encode([
            'status' => 'success',
            'data' => $produtos
        ]);
        break;

    case 'POST':
        $body = json_decode(file_get_contents('php://input'), true);
        $nome = trim($body['nome']);
        $preco = trim($body['preco']);
        $categoria = trim($body['categoria']);

        if(!$nome || !$preco || !$categoria){
            echo json_encode([
                'status' => 'error',
                'message' => 'Algum campo não informado'
            ]);
            break;
        }
        $database->executeQuery(
            "INSERT INTO produtos (nome, preco, categoria_id, disponivel) VALUES (:nome, :preco, :categoria_id, :disponivel)",
            [ ':nome' => $nome, ':preco' => $preco, ':categoria_id' => $categoria, ':disponivel' => 1 ]
        );

        http_response_code(201);
        echo json_encode([
            'status' => 'success',
            'message' => 'Produto cadastrado com sucesso',
            'idProduto' => $database->lastInsertId()
        ]);
        
        break;
    
    case 'PUT':
        // adicionar depois
        break;
    
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Informe o id do produto na URL.'
            ]);
            break;
        }
        $stmt = $database->executeQuery('DELETE FROM produtos WHERE id = :id', [':id' => $id]);
 
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Produto não encontrado.'
            ]);
            break;
        }
 
        echo json_encode([
            'status'  => 'success',
            'message' => 'Produto removido com sucesso.'
        ]);
        break;
 
    default:
        http_response_code(405);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Método não permitido.'
        ]);
}
?>