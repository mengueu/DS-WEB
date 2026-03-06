<?php
    require_once 'conexao.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
            
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $idusuario = $_GET['id']; // Captura o ID do usuário a partir da URL

            $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $idusuario"; // Comando SQL para atualizar os dados do usuário
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                header("Location: exemplopratico.php");
            } else {
                echo "Erro ao editar: " . mysqli_error($conexao);
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar</title>
</head>
<body>
    <?php
        $idusuario = $_GET['id'];
        $sql = "SELECT * FROM usuarios WHERE id = $idusuario";
        $resultado = mysqli_query($conexao, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            //capturar os dados do usuário
            $linha = mysqli_fetch_assoc($resultado);
        } else {
            echo "Usuário não encontrado.";
            header("Location: exemplopratico.php");
            exit;
        }
    ?>

    <div class="edicao">

        <a href="exemplopratico.php"><button>Voltar</button></a>

        <h1>Edição de Usuários:</h1>
        <form action="editar.php?id=<?=$idusuario?>" method="POST">

        <h2>Dados Atuais:</h2>
        <label for="nome">Nome do Usuário: <?=$linha['nome']; // Forma contraída de escrever um echo?> </label>
        <br>
        <label for="email">Email do Usuário: <?=$linha['email'];?></label>
        <br>
        <label for="senha">Senha do Usuário: <?= $linha['senha']; ?></label>
        <br>

        <h2>Novos Dados:</h2>
        <label for="nome">Nome do Usuário:</label>
        <input type="text" id="nome" name="nome"><br><br>

        <label for="email">Email do Usuário:</label>
        <input type="email" id="email" name="email" placeholder="email@exemplo.com"><br><br>

        <label for="senha">Senha do Usuário:</label>
        <input type="password" id="senha" name="senha"><br><br>

        <button type="submit">Editar</button>
    </div>  
</body>
</html>