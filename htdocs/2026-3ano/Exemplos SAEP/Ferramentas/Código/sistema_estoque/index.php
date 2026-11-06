<?php 
require_once 'helpers/auth.php';
require_once 'includes/header.php'; 
?>
<div class="p-5 mb-4 bg-primary text-white rounded-3 shadow">
    <div class="container-fluid py-2">
        <h1 class="display-5 fw-bold">Bem-vindo(a), <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
        <p class="col-md-8 fs-4">Sistema de Gestão e Controlo de Estoque para ferramentas e equipamentos manuais.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card text-center shadow-sm border-0 mb-4">
            <div class="card-body py-5">
                <h4 class="card-title text-primary">Cadastro de Produto</h4>
                <p class="card-text text-muted mb-4">Efectue o registo, edição e exclusão de produtos no sistema.</p>
                <a href="produtos.php" class="btn btn-primary w-50">Aceder</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center shadow-sm border-0 mb-4">
            <div class="card-body py-5">
                <h4 class="card-title text-success">Gestão de Estoque</h4>
                <p class="card-text text-muted mb-4">Registe entradas e saídas de ferramentas e visualize o histórico.</p>
                <a href="estoque.php" class="btn btn-success w-50">Aceder</a>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>