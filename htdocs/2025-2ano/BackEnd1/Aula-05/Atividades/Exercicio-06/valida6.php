<meta charset="UTF-8">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $produto = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_STRING);
        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
        $desconto = filter_input(INPUT_POST, 'desconto', FILTER_VALIDATE_INT);

        if (isset($produto) && !empty($preco) && !empty($desconto)) {
            if (is_numeric($preco) && ($desconto >= 0) && ($desconto <= 100)) {
                $precocomdesconto = $preco - ($preco * ($desconto / 100));
                echo "Produto: ". $produto ."<br>";
                echo "Preço original: R$ " . $preco . "<br>";
                echo "Preço com desconto: R$ " . $precocomdesconto . "<br>";
            } else {
                echo "O preço deve ser um número e o desconto deve estar entre 0% e 100%.";
            }
        } else {
            echo "Todos os campos devem ser preenchidos.";
        }
    }
?>