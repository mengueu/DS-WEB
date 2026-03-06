<?php

class Fabricante {
    public $nome;
    public $paisOrigem;

    public function __construct($nome, $paisOrigem) {
        $this->nome = $nome;
        $this->paisOrigem = $paisOrigem;
    }

    public function exibirFabricante() {
        return "Fabricante: " . $this->nome . " | Origem: " . $this->paisOrigem;
    }
}

class Motor {
    public $potencia;
    public $combustivel;

    public function __construct($potencia, $combustivel) {
        $this->potencia = $potencia;
        $this->combustivel = $combustivel;
    }

    public function exibirMotor() {
        return "Motor: " . $this->potencia . " | Combustível: " . $this->combustivel;
    }
}

class Carro {
    public $modelo;
    public $ano;
    public Fabricante $fabricante;
    public Motor $motor;

    public function __construct($modelo, $ano, Fabricante $fabricante, Motor $motor) {
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->fabricante = $fabricante;
        $this->motor = $motor;
    }

    public function exibirFicha() {
        return $this->modelo . " | " . $this->ano . "<br>" . $this->fabricante->exibirFabricante() . "<br>" . $this->motor->exibirMotor();
    }
}

$motor = new Motor("150cv", "Flex");
$fabricante = new Fabricante("Honda", "Japão");
$carro = new Carro("Civis", 2024, $fabricante, $motor);

echo $carro->exibirFicha();

?>