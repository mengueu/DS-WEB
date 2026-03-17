<?php
class Arduino {
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
    public function lento(){ 
        $this->enviarComando("0"); 
    }
    public function moderado(){ 
        $this->enviarComando("1"); 
    }
    public function rapido(){ 
        $this->enviarComando("2"); 
    }
    public function parar(){ 
        $this->enviarComando("3"); 
    }
}
?>