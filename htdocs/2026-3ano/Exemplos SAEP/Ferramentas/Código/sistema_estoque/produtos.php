<?php
require_once 'helpers/auth.php';
require_once 'config/database.php';
$pdo = getDBConnection();
$mensagemSucesso = ''; $mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'salvar') {
    $id = intval($_POST['id'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = floatval($_POST['preco'] ?? 0);
    $id_categoria = intval($_POST['id_categoria'] ?? 0);
    $id_fornecedor = intval($_POST['id_fornecedor'] ?? 0);

    if (empty($nome) || $preco <= 0 || $id_categoria == 0 || $id_fornecedor == 0) {
        $mensagemErro = 'Preencha todos os campos obrigatórios (Nome, Preço, Categoria, Fornecedor).';
    } else {
        try {
            if ($id > 0) {
                $stmt = $pdo->prepare("UPDATE Produto SET nome=?, descricao=?, preco=?, id_categoria=?, id_fornecedor=? WHERE id=?");
                $stmt->execute([$nome, $descricao, $preco, $id_categoria, $id_fornecedor, $id]);
                $mensagemSucesso = "Produto atualizado!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO Produto (nome, descricao, preco, id_categoria, id_fornecedor) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nome, $descricao, $preco, $id_categoria, $id_fornecedor]);
                $mensagemSucesso = "Produto cadastrado!";
            }
        } catch (PDOException $e) {
            $mensagemErro = 'Erro na base de dados: ' . $e->getMessage();
        }
    }
}

if (isset($_GET['delete'])) {
    $idDelete = intval($_GET['delete']);
    try {
        $pdo->prepare("DELETE FROM Produto WHERE id = ?")->execute([$idDelete]);
        $mensagemSucesso = "Produto excluído!";
    } catch (PDOException $e) {
        $mensagemErro = 'Não é possível excluir um produto que possui movimentações de estoque (Restrição de Chave Estrangeira).';
    }
}

$editar = ['id' => 0, 'nome' => '', 'descricao' => '', 'preco' => '', 'id_categoria' => '', 'id_fornecedor' => ''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM Produto WHERE id = ?");
    $stmt->execute([intval($_GET['edit'])]);
    if ($res = $stmt->fetch()) $editar = $res;
}

$categorias = $pdo->query("SELECT * FROM Categoria ORDER BY nome")->fetchAll();
$fornecedores = $pdo->query("SELECT * FROM Fornecedor ORDER BY nome")->fetchAll();
$lista = $pdo->query("SELECT p.*, c.nome as cat_nome, f.nome as forn_nome FROM Produto p JOIN Categoria c ON p.id_categoria = c.id JOIN Fornecedor f ON p.id_fornecedor = f.id ORDER BY p.id DESC")->fetchAll();

require_once 'includes/header.php'; 
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Cadastro de Produto</h2>
</div>

<?php if($mensagemSucesso) echo "<div class='alert alert-success'>$mensagemSucesso</div>"; ?>
<?php if($mensagemErro) echo "<div class='alert alert-danger'>$mensagemErro</div>"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white"><?= $editar['id'] ? 'Editar Produto' : 'Novo Produto' ?></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="salvar">
            <input type="hidden" name="id" value="<?= $editar['id'] ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nome do Produto *</label>
                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($editar['nome']) ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Preço *</label>
                    <input type="number" step="0.01" name="preco" class="form-control" value="<?= htmlspecialchars($editar['preco']) ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($editar['descricao']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Categoria *</label>
                    <select name="id_categoria" class="form-control" required>
                        <option value="">Selecione...</option>
                        <?php foreach($categorias as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= $editar['id_categoria'] == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Fornecedor *</label>
                    <select name="id_fornecedor" class="form-control" required>
                        <option value="">Selecione...</option>
                        <?php foreach($fornecedores as $f): ?>
                            <option value="<?= $f['id'] ?>" <?= $editar['id_fornecedor'] == $f['id'] ? 'selected' : '' ?>><?= htmlspecialchars($f['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <?php if($editar['id']): ?><a href="produtos.php" class="btn btn-secondary">Cancelar</a><?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <span>Listagem de Produtos</span>
        <input type="text" id="campoBusca" class="form-control form-control-sm w-25" placeholder="Procurar produto...">
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0" id="tabelaProdutos">
            <thead class="table-dark">
                <tr><th>ID</th><th>Nome</th><th>Categoria</th><th>Fornecedor</th><th>Preço</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($lista as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td class="nome-prod"><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['cat_nome']) ?></td>
                    <td><?= htmlspecialchars($item['forn_nome']) ?></td>
                    <td>€ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="?edit=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Filtro dinâmico
document.getElementById('campoBusca').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tabelaProdutos tbody tr');
    rows.forEach(row => {
        let text = row.querySelector('.nome-prod').textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
<?php require_once 'includes/footer.php'; ?>