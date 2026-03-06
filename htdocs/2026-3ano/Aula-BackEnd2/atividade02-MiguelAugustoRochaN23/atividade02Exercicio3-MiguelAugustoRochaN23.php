<?php
    class Veiculo{
        public $marca;
        public $modelo;
        private $velocidade;

        public function getMarca(){
            return $this->marca;
        }
        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function getModelo(){
            return $this->modelo;
        }
        public function setModelo($modelo){
            $this->modelo = $modelo;
        }

        public function getVelocidade(){
            return $this->velocidade;
        }
        public function setVelocidade($velocidade){
            $this->velocidade = $velocidade;
        }
    }

    class Carro extends Veiculo{
        public function acelerar(){
            $this->setVelocidade($this->getVelocidade());
        }
    }
    class Moto extends Veiculo{
        public function acelerar(){
            $this->setVelocidade($this->getVelocidade());
        }
    }

$carro = new Carro();
$carro->setMarca("Toyota");
$carro->setModelo("Corolla");
$carro->setVelocidade("80 Km/h");
echo "Carro: " . $carro->getMarca() . " " . $carro->getModelo() . ", velocidade: " . $carro->getVelocidade() . "<br/> <br/>";

$moto = new Moto();
$moto->setMarca("Honda");
$moto->setModelo("CBR600RR");
$moto->setVelocidade("120 Km/h");
echo "Moto: " . $moto->getMarca() . " " . $moto->getModelo() . ", velocidade: " . $moto->getVelocidade();