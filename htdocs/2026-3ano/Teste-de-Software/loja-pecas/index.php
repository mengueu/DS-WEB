<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechForge - Loja de Peças</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <span class="highlight">Tech</span>Forge
        </div>
        <nav>
            <a href="index.php" class="active">Produtos</a>
            <a href="cadastrar.php">Cadastrar Peça</a>
            <a href="gerenciar.php">Gerenciar</a>
        </nav>
        <div class="cart-icon" onclick="toggleCart()">
            🛒 <span id="cart-count">0</span>
        </div>
    </header>

    <main class="container">
        <div class="hero">
            <h1>Hardware de Alta Performance</h1>
            <p>Encontre as melhores peças para o seu setup gamer ou workstation.</p>
        </div>

        <div class="products-grid">
            <?php
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<img src="'.$row["imagem"].'" alt="'.$row["nome"].'">';
                    echo '<div class="product-info">';
                    echo '<h3>'.$row["nome"].'</h3>';
                    echo '<p>'.$row["descricao"].'</p>';
                    echo '<div class="price">R$ '.number_format($row["preco"], 2, ',', '.').'</div>';
                    echo '<button onclick="adicionarAoCarrinho('.$row["id"].', \''.$row["nome"].'\', '.$row["preco"].')">Adicionar ao Carrinho</button>';
                    echo '</div></div>';
                }
            } else {
                echo "<p>Nenhum produto encontrado no banco de dados.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Carrinho Sidebar -->
    <div id="cart-sidebar" class="cart-sidebar">
        <div class="cart-header">
            <h2>Seu Carrinho</h2>
            <button class="close-btn" onclick="toggleCart()">×</button>
        </div>
        <div id="cart-items" class="cart-items">
            <!-- Itens inseridos via JS -->
        </div>
        <div class="cart-footer">
            <div class="total">
                Total: R$ <span id="cart-total">0.00</span>
            </div>
            <!-- ERRO 3: Função com nome incorreto -->
            <button class="btn-clear" onclick="limparCarrilho()">Limpar Carrinho</button>
            <button class="btn-checkout" onclick="finalizarCompra()">Finalizar Compra</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
