<?php
require_once 'helpers/auth.php';
require_once 'helpers/logger.php';
require_once 'config/database.php';
$pdo = getDBConnection();
$mensagemSucesso = ''; $mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'salvar') {
    $id = intval($_POST['id_editora'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $cnpj = trim($_POST['cnpj'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (empty($nome) || empty($cnpj)) {
        $mensagemErro = 'Preencha o nome e o CNPJ.';
    } else {
        try {
            if ($id > 0) {
                $stmt = $pdo->prepare("UPDATE editoras SET nome=?, cnpj=?, telefone=? WHERE id_editora=?");
                $stmt->execute([$nome, $cnpj, $telefone, $id]);
                $mensagemSucesso = "Editora atualizada!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO editoras (nome, cnpj, telefone) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $cnpj, $telefone]);
                $mensagemSucesso = "Editora cadastrada!";
            }
        } catch (PDOException $e) {
            $mensagemErro = ($e->getCode() == 23000) ? 'Erro: CNPJ já existe.' : 'Erro na base de dados.';
        }
    }
}

if (isset($_GET['delete'])) {
    $idDelete = intval($_GET['delete']);
    try {
        $stmtBusca = $pdo->prepare("SELECT nome FROM editoras WHERE id_editora = ?");
        $stmtBusca->execute([$idDelete]);
        if ($editora = $stmtBusca->fetch()) {
            $pdo->prepare("DELETE FROM editoras WHERE id_editora = ?")->execute([$idDelete]);
            $mensagemSucesso = "Editora excluída!";
            registrarLog("EXCLUSAO: Editora #$idDelete ({$editora['nome']}) excluída pelo usuário ID {$_SESSION['usuario_id']}.");
        }
    } catch (PDOException $e) {
        $mensagemErro = 'Erro ao excluir a editora.';
    }
}

$editar = ['id_editora' => 0, 'nome' => '', 'cnpj' => '', 'telefone' => ''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM editoras WHERE id_editora = ?");
    $stmt->execute([intval($_GET['edit'])]);
    if ($res = $stmt->fetch()) $editar = $res;
}
$lista = $pdo->query("SELECT * FROM editoras ORDER BY id_editora DESC")->fetchAll();
require_once 'includes/header.php'; 
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Módulo de Editoras</h2>
</div>
<?php if($mensagemSucesso) echo "<div class='alert alert-success'>$mensagemSucesso</div>"; ?>
<?php if($mensagemErro) echo "<div class='alert alert-danger'>$mensagemErro</div>"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-danger text-white"><?= $editar['id_editora'] ? 'Editar Editora' : 'Nova Editora' ?></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="salvar">
            <input type="hidden" name="id_editora" value="<?= $editar['id_editora'] ?>">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($editar['nome']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>CNPJ</label>
                    <input type="text" name="cnpj" class="form-control" value="<?= htmlspecialchars($editar['cnpj']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($editar['telefone']) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <?php if($editar['id_editora']): ?><a href="editoras.php" class="btn btn-secondary">Cancelar</a><?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Listagem de Editoras</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr><th>ID</th><th>Nome</th><th>CNPJ</th><th>Telefone</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($lista as $item): ?>
                <tr>
                    <td><?= $item['id_editora'] ?></td>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['cnpj']) ?></td>
                    <td><?= htmlspecialchars($item['telefone']) ?></td>
                    <td>
                        <a href="?edit=<?= $item['id_editora'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?delete=<?= $item['id_editora'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?');">Deletar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
