<?php
    class Arduino {
        private $porta;

        public function __construct($porta) {
            $this->porta = $porta;
        }

        private function enviarComando($comando){
            $cmd = "echo " . $comando . ">" . $this->porta;
            exec($cmd);
        }
        public function ligar(){
            $this->enviarComando("l") || $this->enviarComando("L");
        }
        public function desligar(){
            $this->enviarComando("d") || $this->enviarComando("D");
        }
    }
?>