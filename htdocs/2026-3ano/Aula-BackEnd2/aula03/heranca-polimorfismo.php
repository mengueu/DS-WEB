<?php
// HERANÇA + POLIMORFISMO

class Pessoa{
    public $nome = "Rasmus";
    protected $idade = 48;
    private $senha = "12345"; // senha é privada, somente a classe tem acesso
    public function verDados(){

        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>";

    }
}
class Programador extends Pessoa{
    public function verDados(){

        echo get_class($this) . "<br/>";
        echo $this->nome . "<br/>";
        echo $this->idade . "<br/>";
        echo $this->senha . "<br/>"; // Não vai funcionar, pois é privado, nem as classes filhas tem acesso

        /* a função 'verDados()' da classe filha tenta sobrescrever a função 'verDados()' da classe pai, 
        mas como a variável '$senha' é privada, ela não tem acesso a essa variável, e por isso dá erro. 
        Se a variável '$senha' fosse protegida, ela teria acesso a essa variável, e não daria erro.
        */

    }
}
$objeto = new Programador();
$objeto->verDados();

echo "<br>A função 'verDados()' da classe filha tenta sobrescrever a função 'verDados()' da classe pai, 
        mas como a variável 'senha' é privada, ela não tem acesso a essa variável, e por isso dá erro. 
        Se a variável 'senha' fosse protegida, ela teria acesso a essa variável, e não daria erro."
?>