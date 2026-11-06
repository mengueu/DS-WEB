<?php 
require_once 'helpers/auth.php';
require_once 'helpers/logger.php';
require_once 'config/database.php';
$pdo = getDBConnection();

$totalAlunos = $pdo->query("SELECT COUNT(*) FROM alunos")->fetchColumn();
$totalAutores = $pdo->query("SELECT COUNT(*) FROM autores")->fetchColumn();
$totalEditoras = $pdo->query("SELECT COUNT(*) FROM editoras")->fetchColumn();

require_once 'includes/header.php'; 
?>
<div class="p-5 mb-4 bg-primary text-white rounded-3 shadow">
    <div class="container-fluid py-2">
        <h1 class="display-5 fw-bold">Gestão de Biblioteca</h1>
        <p class="col-md-8 fs-4">Sistema desenvolvido para a prova prática do SAEP, utilizando PHP PDO, MySQL e Bootstrap 5.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center shadow-sm border-0 mb-4">
            <div class="card-body py-4">
                <h3 class="card-title text-primary"><?= $totalAlunos ?></h3>
                <p class="card-text text-muted mb-3">Alunos Registados</p>
                <a href="alunos.php" class="btn btn-outline-primary w-100">Gerir Alunos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow-sm border-0 mb-4">
            <div class="card-body py-4">
                <h3 class="card-title text-success"><?= $totalAutores ?></h3>
                <p class="card-text text-muted mb-3">Autores Registados</p>
                <a href="autores.php" class="btn btn-outline-success w-100">Gerir Autores</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow-sm border-0 mb-4">
            <div class="card-body py-4">
                <h3 class="card-title text-danger"><?= $totalEditoras ?></h3>
                <p class="card-text text-muted mb-3">Editoras Registadas</p>
                <a href="editoras.php" class="btn btn-outline-danger w-100">Gerir Editoras</a>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
