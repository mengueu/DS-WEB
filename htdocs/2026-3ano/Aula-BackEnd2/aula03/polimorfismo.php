<?php
// POLIMORFISMO 

class Animal{
    public function falar(){
        return "Som";
    }
    public function mover(){
        return "Anda";
    }
}
class Cachorro extends Animal{ // Herdando a classe Animal e modificando o método falar
    public function falar()
    {
        return "Late";
    }
}
class Gato extends Animal{
    public function falar(){
        return "Mia";
    }
}
class Passaro extends Animal{
    public function falar(){
        return "Canta";
    }
    public function mover(){
        return "Voa e " . parent::mover();
    }
}

$pluto = new Cachorro(); // Criando um objeto da classe Cachorro, que é filha da classe Animal
echo $pluto->falar() . "<br/>"; /* O método falar do objeto pluto vai chamar o método falar da classe Cachorro, 
pois o método falar da classe Cachorro sobrescreve o método falar da classe Animal */
echo $pluto->mover() . "<br/>";
echo "-------------------------<br/>";

$garfield = new Gato();
echo $garfield->falar() . "<br/>";
echo $garfield->mover() . "<br/>";
echo "-------------------------<br/>";

$ave = new Passaro();
echo $ave->falar() . "<br/>";
echo $ave->mover() . "<br/>";
?>