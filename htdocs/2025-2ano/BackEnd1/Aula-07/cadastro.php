<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
            
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            require_once 'conexao.php';

            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email' , '$senha')";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                echo "Usuário cadastrado com sucesso!";
                header("Location: exemplopratico.php");
            } else {
                echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
            }
        }
    }
?>