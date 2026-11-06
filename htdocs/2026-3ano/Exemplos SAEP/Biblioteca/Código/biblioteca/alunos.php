<?php
require_once 'helpers/auth.php';
require_once 'helpers/logger.php';
require_once 'config/database.php';
$pdo = getDBConnection();
$mensagemSucesso = ''; $mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'salvar') {
    $id = intval($_POST['id_aluno'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $matricula = trim($_POST['matricula'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($nome) || empty($matricula) || empty($email)) {
        $mensagemErro = 'Preencha todos os campos obrigatórios.';
    } else {
        try {
            if ($id > 0) {
                $stmt = $pdo->prepare("UPDATE alunos SET nome = ?, matricula = ?, email = ? WHERE id_aluno = ?");
                $stmt->execute([$nome, $matricula, $email, $id]);
                $mensagemSucesso = "Aluno atualizado com sucesso!";
                registrarLog("EDICAO: Aluno #$id ($nome) editado pelo usuário ID {$_SESSION['usuario_id']}.");
            } else {
                $stmt = $pdo->prepare("INSERT INTO alunos (nome, matricula, email) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $matricula, $email]);
                $mensagemSucesso = "Aluno cadastrado com sucesso!";
                registrarLog("CADASTRO: Aluno $nome criado pelo usuário ID {$_SESSION['usuario_id']}.");
            }
        } catch (PDOException $e) {
            $mensagemErro = ($e->getCode() == 23000) ? 'Erro: Matrícula ou E-mail já existem.' : 'Erro na base de dados.';
        }
    }
}

if (isset($_GET['delete'])) {
    $idDelete = intval($_GET['delete']);
    try {
        $stmtBusca = $pdo->prepare("SELECT nome FROM alunos WHERE id_aluno = ?");
        $stmtBusca->execute([$idDelete]);
        if ($aluno = $stmtBusca->fetch()) {
            $pdo->prepare("DELETE FROM alunos WHERE id_aluno = ?")->execute([$idDelete]);
            $mensagemSucesso = "Aluno excluído com sucesso!";
            registrarLog("EXCLUSAO: Aluno #$idDelete ({$aluno['nome']}) excluído pelo usuário ID {$_SESSION['usuario_id']}.");
        }
    } catch (PDOException $e) {
        $mensagemErro = 'Erro ao excluir o aluno.';
    }
}

$editar = ['id_aluno' => 0, 'nome' => '', 'matricula' => '', 'email' => ''];
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id_aluno = ?");
    $stmt->execute([intval($_GET['edit'])]);
    if ($res = $stmt->fetch()) $editar = $res;
}
$lista = $pdo->query("SELECT * FROM alunos ORDER BY id_aluno DESC")->fetchAll();
require_once 'includes/header.php'; 
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Módulo de Alunos</h2>
</div>
<?php if($mensagemSucesso) echo "<div class='alert alert-success'>$mensagemSucesso</div>"; ?>
<?php if($mensagemErro) echo "<div class='alert alert-danger'>$mensagemErro</div>"; ?>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white"><?= $editar['id_aluno'] ? 'Editar Aluno' : 'Novo Aluno' ?></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="action" value="salvar">
            <input type="hidden" name="id_aluno" value="<?= $editar['id_aluno'] ?>">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($editar['nome']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Matrícula</label>
                    <input type="text" name="matricula" class="form-control" value="<?= htmlspecialchars($editar['matricula']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($editar['email']) ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <?php if($editar['id_aluno']): ?><a href="alunos.php" class="btn btn-secondary">Cancelar</a><?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Listagem</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr><th>ID</th><th>Nome</th><th>Matrícula</th><th>E-mail</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach($lista as $item): ?>
                <tr>
                    <td><?= $item['id_aluno'] ?></td>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['matricula']) ?></td>
                    <td><?= htmlspecialchars($item['email']) ?></td>
                    <td>
                        <a href="?edit=<?= $item['id_aluno'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?delete=<?= $item['id_aluno'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?');">Deletar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
