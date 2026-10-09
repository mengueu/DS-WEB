<?php
include 'db.php';
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ERRO 2: O formulário HTML envia o campo com name='nome_peca', 
    // mas o PHP está tentando capturar a variável 'nome'. 
    // O banco de dados vai salvar o produto com nome vazio.
    $nome = $_POST['nome'] ?? ''; 
    
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $imagem);
    
    if ($stmt->execute()) {
        $mensagem = "<div class='alert success'>Produto cadastrado com sucesso!</div>";
    } else {
        $mensagem = "<div class='alert error'>Erro ao cadastrar produto.</div>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar - TechForge</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <span class="highlight">Tech</span>Forge
        </div>
        <nav>
            <a href="index.php">Produtos</a>
            <a href="cadastrar.php" class="active">Cadastrar Peça</a>
            <a href="gerenciar.php">Gerenciar</a>
        </nav>
    </header>

    <main class="container">
        <div class="form-container">
            <h2>Cadastrar Nova Peça</h2>
            <?php echo $mensagem; ?>
            
            <form method="POST" action="cadastrar.php">
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <!-- Campo tem o name="nome_peca" -->
                    <input type="text" id="nome" name="nome_peca" required placeholder="Ex: Placa de Vídeo RTX 3060">
                </div>
                
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required placeholder="Detalhes técnicos da peça..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" step="0.01" id="preco" name="preco" required placeholder="1500.00">
                </div>
                
                <div class="form-group">
                    <label for="imagem">URL da Imagem</label>
                    <input type="url" id="imagem" name="imagem" required placeholder="https://exemplo.com/imagem.jpg">
                </div>
                
                <button type="submit" class="btn-submit">Salvar Produto</button>
            </form>
        </div>
    </main>
</body>
</html>
