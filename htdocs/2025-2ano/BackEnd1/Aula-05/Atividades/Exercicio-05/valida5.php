<meta charset="UTF-8"> 
<?php
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if (!(isset($usuario) && empty($senha))) {
        if (strlen($usuario) >= 5 && strlen($senha) >= 8) {
            echo "Login aceito.<br>- Usuário válido: ". strlen($usuario) ." caracteres.<br>- Senha válida: ". strlen($senha) ." caracteres.";
        } elseif (strlen($usuario) < 5 && strlen($senha) >= 8) {
            echo "Usuário inválido. O usuário deve ter pelo menos 5 caracteres.<br>- Senha válida: ". strlen($senha) ." caracteres.";
        } elseif (strlen($usuario) >= 5 && strlen($senha) < 8) {
            echo "- Usuário válido: ". strlen($usuario) ." caracteres.<br>- Senha inválida. A senha deve ter pelo menos 8 caracteres.";
        } else {
            echo "Usuário e senha inválidos.<br>O usuário deve ter pelo menos 5 caracteres e a senha deve ter pelo menos 8 caracteres.";
        }
    } else {
        echo "Por favor, preencha ambos os campos.";
    }
?>