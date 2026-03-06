<?php
    class Pessoa {
        public string $nome; // É possível definir o tipo da variável
        public int $idade;

        public function __construct($novoNome, $novaIdade){ // Método construtor, serve para construir uma função com múltiplos dados
            $this->nome = $novoNome;
            $this->idade = $novaIdade;
        }

        public function exibirDados(){
            return "O nome da pessoa é " . $this->nome . " e a idade é " . $this->idade;
        }

        public function alterarDados($novoNome, $novaIdade){
            $this->nome = $novoNome;
            $this->idade = $novaIdade;
        }
    }

$pessoa = new Pessoa("Carlos", 17);
echo $pessoa->exibirDados();

echo "<br>";

$pessoa->alterarDados("André", 18);
echo $pessoa->exibirDados();


?>