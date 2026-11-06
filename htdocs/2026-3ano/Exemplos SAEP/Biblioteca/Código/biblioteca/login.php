<?php
session_start();
require_once 'config/database.php';
require_once 'helpers/logger.php';

// Se já está logado, redireciona
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
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        // Verifica a senha. A senha padrão do banco para admin@senai.br é 123456
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            registrarLog("LOGIN: Usuário {$usuario['nome']} entrou no sistema.");
            header("Location: index.php");
            exit;
        } else {
            $erro = "Falha na autenticação: E-mail ou senha inválidos.";
            registrarLog("LOGIN FALHO: Tentativa de acesso negada para o e-mail: $email.");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SAEP Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow" style="width: 400px;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">Acesso ao Sistema</h4>
        </div>
        <div class="card-body p-4">
            <?php if ($erro): ?>
                <div class="alert alert-danger p-2 text-center"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">E-mail de Acesso</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@senai.br" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="******" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Entrar</button>
            </form>
            <div class="text-center mt-3 text-muted" style="font-size: 0.85em;">
                E-mail: admin@senai.br <br> Senha: 123456
            </div>
        </div>
    </div>
</body>
</html>