<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar - TechForge</title>
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
        <div class="cart-icon" onclick="toggleCart()">
            🛒 <span id="cart-count">0</span>
        </div>
    </header>

    <main class="container">
        <div class="admin-header">
            <h2>Gerenciar Peças</h2>
            <a href="cadastrar.php" class="btn-new">+ Nova Peça</a>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM produtos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td><img src='".$row['imagem']."' alt='Img' class='table-img'></td>";
                            echo "<td>".(!empty($row['nome']) ? $row['nome'] : '<i style="color:var(--text-muted);">Sem nome</i>')."</td>";
                            echo "<td>R$ ".number_format($row["preco"], 2, ',', '.')."</td>";
                            echo "<td class='actions'>";
                            echo "<a href='editar.php?id=".$row['id']."' class='btn-edit'>Editar</a>";
                            echo "<a href='excluir.php?id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir esta peça?\")'>Excluir</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Nenhuma peça encontrada.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <!-- Sidebar oculta para evitar erros no JS -->
    <div id="cart-sidebar" class="cart-sidebar">
        <div class="cart-header">
            <h2>Seu Carrinho</h2>
            <button class="close-btn" onclick="toggleCart()">×</button>
        </div>
        <div id="cart-items" class="cart-items"></div>
        <div class="cart-footer">
            <div class="total">Total: R$ <span id="cart-total">0.00</span></div>
            <button class="btn-clear" onclick="limparCarrilho()">Limpar Carrinho</button>
            <button class="btn-checkout" onclick="finalizarCompra()">Finalizar Compra</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
