<?php
    class Dono{
        public $nome;
        public $telefone;

        public function __construct($novoNome, $novoTelefone){
            $this->nome = $novoNome;
            $this->telefone = $novoTelefone;
        }

        public function exibir(){
            return $this->nome . "|" . $this->telefone;
        }
    }
    class Animal{
        public $nome;
        public $especie;
        public Dono $dono;

        public function __construct($novoNome, $novaEspecie, Dono $novoDono){
            $this->nome = $novoNome;
            $this->especie = $novaEspecie;
            $this->dono = $novoDono;
        }

        public function exibirAnimal(){
            return $this->nome . " | " . $this->especie;
        }

        public function exibirDono(){
            return "Dono: " . $this->dono->nome . " | Tel: " . $this->dono->telefone;
        }
    }

$dono = new Dono("João", "(11) 99999-9999");
$cachorro = new Animal("Rex", "Cachorro", $dono);

echo $cachorro->exibirAnimal();
echo "<br>";
echo $cachorro->exibirDono();
?>