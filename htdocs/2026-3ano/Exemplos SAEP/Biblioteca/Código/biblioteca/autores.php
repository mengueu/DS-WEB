<?php
require_once 'helpers/auth.php';
require_once 'helpers/logger.php';
require_once 'config/database.php';
$pdo = getDBConnection();
$mensagemSucesso = ''; $mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'salvar') {
    $id = intval($_POST['id_autor'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $nacionalidade = trim($_POST['nacionalidade'] ?? '');

    if (empty($nome)) {
        $mensagemErro = 'Preencha o nome do autor.';
    } else {
        try {
            if ($id > 0) {
                $stmt = $pdo->prepare("UPDATE autores SET nome = ?, nacionalidade = ? WHERE id_autor = ?");
                $stmt->execute([$nome, $nacionalidade, $id]);
                $mensagemSucesso = "Autor atualizado com sucesso!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO autores (nome, nacionalidade) VALUES (?, ?)");
                $stmt->execute([$nome, $nacionalidade]);
                $mensagemSucesso = "Autor cadastrado com sucesso!";
            }
        } catch (PDOException $e) {
            $mensagemErro = 'Erro na base de dados.';
        }
    }
}

if (isset($_GET['delete'])) {
    $idDelete = intval($_GET['delete']);
    try {
        $stmtBusca = $pdo->prepare("SELECT nome FROM autores WHERE id_autor = ?");
        $stmtBusca->execute([$idDelete]);
        if ($autor = $stmtBusca->fetch()) {
            $pdo->prepare("DELETE FROM autores WHERE id_autor = ?")->execute([$idDelete]);
            $mensagemSucesso = "Autor excluído com sucesso!";
            registrarLog("EXCLUSAO: Autor #$idDelete ({$autor['nome']}) excluído pelo usuário ID {$_SESSION['usuario_id']}.");
        }
    } catch (PDOException $e) {
        $mensagemErro = 'Erro ao excluir o autor.';
    }
}

$editar = ['id_autor' => 0, 'nome' => '', 'nacionalidade' => ''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM autores WHERE id_autor = ?");
    $stmt->execute([intval($_GET['edit'])]);
    if ($res = $stmt->fetch()) $editar = $res;
}
$lista = $pdo->query("SELECT * FROM autores ORDER BY id_autor DESC")->fetchAll();
require_once 'includes/header.php'; 
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Módulo de Autores</h2>
</div>
<?php if($mensagemSucesso) echo "<div class='alert alert-success'>$mensagemSucesso</div>"; ?>
<?php if($mensagemErro) echo "<div class='alert alert-danger'>$mensagemErro</div>"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-success text-white"><?= $editar['id_autor'] ? 'Editar Autor' : 'Novo Autor' ?></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="salvar">
            <input type="hidden" name="id_autor" value="<?= $editar['id_autor'] ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nome do Autor</label>
                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($editar['nome']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Nacionalidade</label>
                    <input type="text" name="nacionalidade" class="form-control" value="<?= htmlspecialchars($editar['nacionalidade']) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <?php if($editar['id_autor']): ?><a href="autores.php" class="btn btn-secondary">Cancelar</a><?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Listagem de Autores</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr><th>ID</th><th>Nome</th><th>Nacionalidade</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($lista as $item): ?>
                <tr>
                    <td><?= $item['id_autor'] ?></td>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['nacionalidade']) ?></td>
                    <td>
                        <a href="?edit=<?= $item['id_autor'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?delete=<?= $item['id_autor'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?');">Deletar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
