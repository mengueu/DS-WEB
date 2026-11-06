<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>SAEP - Controlo de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Controlo de Estoque</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Painel Principal</a></li>
                    <li class="nav-item"><a class="nav-link" href="produtos.php">Cadastro de Produto</a></li>
                    <li class="nav-item"><a class="nav-link" href="estoque.php">Gestão de Estoque</a></li>
                </ul>
                <span class="navbar-text me-3 text-light">
                    Utilizador logado: <strong><?= htmlspecialchars($_SESSION['usuario_nome'] ?? '') ?></strong>
                </span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container py-2">
