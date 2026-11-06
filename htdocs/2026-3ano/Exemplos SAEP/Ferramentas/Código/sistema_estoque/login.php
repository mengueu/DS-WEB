<?php
session_start();
require_once 'config/database.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$erro = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        // NOTA: O script SQL inseriu senhas em texto plano ('senha123'). 
        // Em produção deve usar password_hash() e password_verify().
        if ($usuario && $senha === $usuario['senha']) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header("Location: index.php");
            exit;
        } else {
            $erro = "Utilizador ou palavra-passe inválidos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Controlo de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow" style="width: 400px;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">Autenticação (SAEP)</h4>
        </div>
        <div class="card-body p-4">
            <?php if ($erro): ?>
                <div class="alert alert-danger p-2 text-center"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="joao@empresa.com" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Palavra-passe</label>
                    <input type="password" name="senha" class="form-control" placeholder="senha123" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>