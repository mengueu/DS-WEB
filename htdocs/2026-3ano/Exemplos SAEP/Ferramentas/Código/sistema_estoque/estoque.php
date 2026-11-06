<?php
require_once 'helpers/auth.php';
require_once 'config/database.php';
$pdo = getDBConnection();
$mensagemSucesso = ''; $mensagemErro = ''; $alertaEstoque = '';

$MINIMO_ESTOQUE = 5; // Definido para disparar o alerta RF07

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'movimentar') {
    $id_produto = intval($_POST['id_produto'] ?? 0);
    $tipo = $_POST['tipo'] ?? '';
    $motivo = trim($_POST['motivo'] ?? '');
    $qtd_mov = intval($_POST['qtd'] ?? 0);
    $dta_hora = $_POST['dta_hora'] ?? date('Y-m-d\TH:i');
    $id_usuario = $_SESSION['usuario_id'];

    if ($id_produto == 0 || empty($tipo) || $qtd_mov <= 0 || empty($dta_hora)) {
        $mensagemErro = 'Preencha todos os campos obrigatórios corretamente.';
    } else {
        try {
            $pdo->beginTransaction();
            
            // Busca qtd atual do produto
            $stmtProd = $pdo->prepare("SELECT nome, qtd FROM Produto WHERE id = ? FOR UPDATE");
            $stmtProd->execute([$id_produto]);
            $produtoAtual = $stmtProd->fetch();

            if (!$produtoAtual) throw new Exception("Produto não encontrado.");

            $nova_qtd = $produtoAtual['qtd'];
            if ($tipo === 'entrada') {
                $nova_qtd += $qtd_mov;
            } else if ($tipo === 'saida') {
                if ($produtoAtual['qtd'] < $qtd_mov) {
                    throw new Exception("Quantidade insuficiente em estoque para esta saída.");
                }
                $nova_qtd -= $qtd_mov;
            }

            // Regista Movimentação (Rastreabilidade)
            $stmtMov = $pdo->prepare("INSERT INTO Movimentacao (tipo, motivo, dta_hora, qtd, id_usuario, id_produto) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtMov->execute([$tipo, $motivo, $dta_hora, $qtd_mov, $id_usuario, $id_produto]);

            // Atualiza Estoque Produto
            $stmtUpd = $pdo->prepare("UPDATE Produto SET qtd = ? WHERE id = ?");
            $stmtUpd->execute([$nova_qtd, $id_produto]);

            $pdo->commit();
            $mensagemSucesso = "Movimentação registada com sucesso!";

            // Alerta de Estoque Mínimo
            if ($tipo === 'saida' && $nova_qtd < $MINIMO_ESTOQUE) {
                $alertaEstoque = "Atenção: Produto '{$produtoAtual['nome']}' ficou abaixo do estoque mínimo configurado ($MINIMO_ESTOQUE unidades). Quantidade atual: $nova_qtd.";
            }

        } catch (Exception $e) {
            $pdo->rollBack();
            $mensagemErro = $e->getMessage();
        }
    }
}

// Produtos em ordem alfabética (RF03 / 7.1.1)
$produtosList = $pdo->query("SELECT id, nome, qtd FROM Produto ORDER BY nome ASC")->fetchAll();

// Histórico de Movimentações
$historico = $pdo->query("SELECT m.*, p.nome as prod_nome, u.nome as user_nome FROM Movimentacao m JOIN Produto p ON m.id_produto = p.id JOIN usuario u ON m.id_usuario = u.id ORDER BY m.dta_hora DESC, m.id DESC LIMIT 50")->fetchAll();

require_once 'includes/header.php'; 
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestão de Estoque</h2>
</div>

<?php if($mensagemSucesso) echo "<div class='alert alert-success'>$mensagemSucesso</div>"; ?>
<?php if($mensagemErro) echo "<div class='alert alert-danger'>$mensagemErro</div>"; ?>
<?php if($alertaEstoque) echo "<div class='alert alert-warning fw-bold border-warning'><span class='text-danger'>⚠ Alerta de Sistema:</span> $alertaEstoque</div>"; ?>

<div class="row">
    <!-- Formulário de Movimentação -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">Nova Movimentação</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="movimentar">
                    
                    <div class="mb-3">
                        <label>Produto *</label>
                        <select name="id_produto" class="form-control" required>
                            <option value="">Selecione...</option>
                            <?php foreach($produtosList as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?> (Estoque: <?= $p['qtd'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tipo de Movimentação *</label>
                        <select name="tipo" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Quantidade *</label>
                        <input type="number" name="qtd" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label>Data e Hora da Operação *</label>
                        <input type="datetime-local" name="dta_hora" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Motivo</label>
                        <input type="text" name="motivo" class="form-control" placeholder="Opcional">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Registar Operação</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabela de Histórico -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">Histórico de Rastreabilidade</div>
            <div class="card-body p-0" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-striped mb-0 text-sm">
                    <thead class="table-dark" style="position: sticky; top: 0;">
                        <tr>
                            <th>Data/Hora</th>
                            <th>Produto</th>
                            <th>Tipo</th>
                            <th>Qtd</th>
                            <th>Motivo</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($historico as $h): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($h['dta_hora'])) ?></td>
                            <td><?= htmlspecialchars($h['prod_nome']) ?></td>
                            <td>
                                <?php if($h['tipo'] == 'entrada'): ?>
                                    <span class="badge bg-success">Entrada</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Saída</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= $h['qtd'] ?></td>
                            <td><?= htmlspecialchars($h['motivo']) ?></td>
                            <td><?= htmlspecialchars($h['user_nome']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($historico)): ?>
                            <tr><td colspan="6" class="text-center">Nenhuma movimentação registada.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>