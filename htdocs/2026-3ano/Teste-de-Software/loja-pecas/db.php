<?php
$servername = "localhost";
$username = "root";
$password = "";

// Conecta ao servidor MySQL
$conn = new mysqli($servername, $username, $password);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cria o banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS loja_pecas_db";
$conn->query($sql);

$conn->select_db("loja_pecas_db");

// Cria a tabela de produtos se não existir
$sql = "CREATE TABLE IF NOT EXISTS produtos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255)
)";
$conn->query($sql);

// Insere alguns produtos iniciais se a tabela estiver vazia
$result = $conn->query("SELECT * FROM produtos");
if($result->num_rows == 0) {
    $conn->query("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('Placa de Vídeo RTX 4090', 'A melhor placa de vídeo do mercado para jogar em 4K.', 12500.00, 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=400')");
    $conn->query("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('Processador Intel Core i9', 'Desempenho extremo para jogos e renderização.', 3200.00, 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400')");
    $conn->query("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('Memória RAM 32GB DDR5', 'Velocidade e eficiência para multitarefas.', 950.00, 'https://images.unsplash.com/photo-1562976540-1502f75923aa?auto=format&fit=crop&q=80&w=400')");
}
?>
