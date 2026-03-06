<?php
// ABSTRAÇÃO

abstract class Animal{ /* A classe abstrata não pode ser instanciada, ou seja, não podemos criar objetos 
dessa classe, mas podemos criar classes filhas que herdam essa classe abstrata*/
    public function fazerSom(){
    }
}
class Cachorro extends Animal{
    public function fazerSom(){
        echo "Au Au!";
    }
}
$cachorro = new Cachorro();
$cachorro->fazerSom();

$teste = new Animal(); // Não é possível criar um objeto da classe abstrata, pois ela não pode ser instanciada
$teste->fazerSom(); // Não é possível chamar o método da classe abstrata, pois ela não pode ser instanciada
?>