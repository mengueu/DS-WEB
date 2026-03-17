<?php
class Lampada {
    private $porta;
    public function __construct($porta){
        $this->porta = $porta;
    }
    private function enviarComando($comando){
        $cmdConfig = "mode {$this->porta} BAUD=9600 PARITY=n DATA=8 STOP=1";
        $cmd = "echo $comando > {$this->porta}";
        exec($cmdConfig);
        exec($cmd);
    }
    public function ligar(){
        $this->enviarComando('l');
    }
    public function desligar(){
        $this->enviarComando('d');
    }
    public function piscar(){
        $this->enviarComando('p');
    }
}
?>