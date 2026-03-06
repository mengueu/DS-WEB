<?php
class Dono
{
    public $nome;
    public $telefone;

    public function __construct($novoNome, $novoTelefone)
    {
        $this->nome = $novoNome;
        $this->telefone = $novoTelefone;
    }

    public function exibirDados()
    {
        return $this->nome . "|" . $this->especie;
    }
}

class Animal
{
    public $nome;
    public $especie;
    public Dono $dono;

    public function __construct($novoNome, $novaEspecie, Dono $novoDono)
    {
        $this->nome = $novoNome;
        $this->especie = $novaEspecie;
        $this->dono = $novoDono;
    }

    public function exibirDadosAnimal()
    {
        return $this->nome . " | " . $this->especie;
    }

    public function exibirDadosDono()
    {
        return "Dono: " . $this->dono->nome . " | Tel: " . $this->dono->telefone;
    }
}

$dono = new Dono("Daniel", "(15) 99999-9999");
$cachorro = new Animal("Rex", "Cachorro", $dono);

echo $cachorro->exibirDadosAnimal();
echo "<br>";
echo $cachorro->exibirDadosDono();


?>