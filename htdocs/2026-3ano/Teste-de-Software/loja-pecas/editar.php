<?php
include 'db.php';
$mensagem = "";
$produto = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome_peca']; 
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $stmt = $conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, imagem=? WHERE id=?");
    $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $imagem, $id);
    
    if ($stmt->execute()) {
        $mensagem = "<div class='alert success'>Produto atualizado com sucesso!</div>";
        $produto['nome'] = $nome;
        $produto['descricao'] = $descricao;
        $produto['preco'] = $preco;
        $produto['imagem'] = $imagem;
    } else {
        $mensagem = "<div class='alert error'>Erro ao atualizar produto.</div>";
    }
    $stmt->close();
}

if (!$produto) {
    die("Produto não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - TechForge</title>
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
            <a href="cadastrar.php">Cadastrar Peça</a>
            <a href="gerenciar.php" class="active">Gerenciar</a>
        </nav>
    </header>

    <main class="container">
        <div class="form-container">
            <h2>Editar Peça</h2>
            <?php echo $mensagem; ?>
            
            <form method="POST" action="editar.php?id=<?php echo $produto['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" id="nome" name="nome_peca" required value="<?php echo htmlspecialchars($produto['nome']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" step="0.01" id="preco" name="preco" required value="<?php echo $produto['preco']; ?>">
                </div>
                
                <div class="form-group">
                    <label for="imagem">URL da Imagem</label>
                    <input type="url" id="imagem" name="imagem" required value="<?php echo htmlspecialchars($produto['imagem']); ?>">
                </div>
                
                <button type="submit" class="btn-submit">Atualizar Produto</button>
                <a href="gerenciar.php" style="display:block; text-align:center; margin-top:1rem; color:var(--text-muted); text-decoration:none;">Voltar para o Gerenciamento</a>
            </form>
        </div>
    </main>
</body>
</html>
