<?php
// ENCAPSULAMENTO

class Pessoa{
    public $nome = "Rasmus";
    protected $idade = 48; // Somente a classe e as classes filhas tem acesso
    private $senha = "12345"; // Somente a classe tem acesso, nem as classes filhas tem acesso
    private function verDados(){ // Função privada, não pode ser acessada fora da classe, nem pelas classes filhas
        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>"; // Não vai funcionar, pois é privado
    }

    public function VerDadosFormatados(){ 
        echo "Dados formatados <br>".$this->verDados(); /* A função 'verDados()' é privada, 
        mas como a função 'VerDadosFormatados()' é pública, ela tem acesso a essa função, e por isso funciona. */
    }
}

$bruno = new Pessoa();
$bruno->VerDadosFormatados(); // Vai exibir os dados formatados

$bruno->verDados(); // Vai exibir apenas o nome e idade, mas a senha vai dar erro
?>