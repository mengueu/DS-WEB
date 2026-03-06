<?php
    abstract class Animais{
        abstract function fazerSom();
        function mover(){
            return "anda";
        }
    }

    class Sapo extends Animais{
        function fazerSom(){
            return "coacha";
        }
        function mover(){
            return "Saltitando";
        }
    }

    class Cavalo extends Animais{
        function fazerSom(){
            return "relincha";
        }
        function mover(){
            return "galopa e " . parent::mover();
        }
    }
    class Tartaruga extends Animais{
        function fazerSom(){
            return "som de tartaruga";
        }
        function mover(){
            return "Anda lentamente";
        }
    }

$sapo = new Sapo();
echo "O sapo " . $sapo->fazerSom();

echo "<br/> <br/>";

$cavalo = new Cavalo();
echo "O cavalo " . $cavalo->fazerSom() . ", " . $cavalo->mover();

echo "<br/> <br/>";

$tartaruga = new Tartaruga();
echo "A tartaruga faz " . $tartaruga->fazerSom();