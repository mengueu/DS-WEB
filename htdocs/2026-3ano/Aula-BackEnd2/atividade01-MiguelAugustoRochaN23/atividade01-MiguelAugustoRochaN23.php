<?php
class Computador {
    public $marca;
    public $modelo;
    public $cor;
    public $RAM;
    public $armazenamento;
    
    public function Ligar() {
        return "O computador " . $this->marca . " " . $this->modelo . " está ligado.";
    }

    public function Desligar() {
        return "O computador " . $this->marca . " " . $this->modelo . " está desligado.";
    }

    public function Projetar() {
        return "O computador " . $this->marca . " " . $this->modelo . " está projetando.";
    }
}

echo "<h4>Class Computador</h4>";

$Computador1 = new Computador();
$Computador1->marca = "Dell";
$Computador1->modelo = "Notebook Gamer Alienware 16 Aurora";
$Computador1->cor = "Preto";
$Computador1->RAM = "16GB";
$Computador1->armazenamento = "1TB SSD";
echo $Computador1->Ligar() . "<br>";

$Computador2 = new Computador();
$Computador2->marca = "Apple";
$Computador2->modelo = "MacBook Pro 16";
$Computador2->cor = "Cinza";
$Computador2->RAM = "32GB";
$Computador2->armazenamento = "1TB SSD";
echo $Computador2->Desligar() . "<br>";

$Computador3 = new Computador();
$Computador3->marca = "HP";
$Computador3->modelo = "Pavilion Gaming 15";
$Computador3->cor = "Vermelho";
$Computador3->RAM = "16GB";
$Computador3->armazenamento = "512GB SSD";
echo $Computador3->Projetar() . "<br>";


class Celular {
    public $marca;
    public $modelo;
    public $cor;
    public $RAM;
    public $armazenamento;
    
    public function Ligar() {
        return "O celular " . $this->marca . " " . $this->modelo . " está ligado.";
    }

    public function Desligar() {
        return "O celular " . $this->marca . " " . $this->modelo . " está desligado.";
    }

    public function Fotografar() {
        return "O celular " . $this->marca . " " . $this->modelo . " tirou uma foto.";
    }
}

echo "<h4>Class Celular</h4>";

$Celular1 = new Celular();
$Celular1->marca = "Samsung";
$Celular1->modelo = "Galaxy S21";
$Celular1->cor = "Preto";
$Celular1->RAM = "8GB";
$Celular1->armazenamento = "128GB";
echo $Celular1->Ligar() . "<br>";

$Celular2 = new Celular();
$Celular2->marca = "Apple";
$Celular2->modelo = "iPhone 13 Pro";
$Celular2->cor = "Prata";
$Celular2->RAM = "6GB";
$Celular2->armazenamento = "256GB";
echo $Celular2->Desligar() . "<br>";

$Celular3 = new Celular();
$Celular3->marca = "Xiaomi";
$Celular3->modelo = "Redmi Note 10";
$Celular3->cor = "Azul";
$Celular3->RAM = "4GB";
$Celular3->armazenamento = "64GB";
echo $Celular3->Fotografar() . "<br>";

class Mesa {
    public $material;
    public $cor;
    public $formato;
    public $altura;
    public $largura;
    
    public function Apoiar() {
        return "A mesa de " . $this->material . " está apoiando objetos.";
    }

    public function Colocar() {
        return "A mesa de " . $this->material . " está posicionada.";
    }

    public function Limpar() {
        return "A mesa de " . $this->material . " foi limpa.";
    }
}

echo "<h4>Class Mesa</h4>";

$Mesa1 = new Mesa();
$Mesa1->material = "Madeira";
$Mesa1->cor = "Marrom";
$Mesa1->formato = "Retangular";
$Mesa1->altura = "75cm";
$Mesa1->largura = "120cm";
echo $Mesa1->Apoiar() . "<br>";

$Mesa2 = new Mesa();
$Mesa2->material = "Vidro";
$Mesa2->cor = "Transparente";
$Mesa2->formato = "Redonda";
$Mesa2->altura = "70cm";
$Mesa2->largura = "100cm";
echo $Mesa2->Colocar() . "<br>";

$Mesa3 = new Mesa();
$Mesa3->material = "Metal";
$Mesa3->cor = "Prata";
$Mesa3->formato = "Quadrada";
$Mesa3->altura = "80cm";
$Mesa3->largura = "80cm";
echo $Mesa3->Limpar() . "<br>";

class Caderno {
    public $marca;
    public $numeroDePaginas;
    public $cor;
    public $formato;
    public $tipoDeCapa;
    
    public function Abrir() {
        return "O caderno " . $this->marca . " está aberto.";
    }

    public function Escrever() {
        return "Escrevendo no caderno " . $this->marca . ".";
    }

    public function Fechar() {
        return "O caderno " . $this->marca . " está fechado.";
    }
}

echo "<h4>Class Caderno</h4>";

$Caderno1 = new Caderno();
$Caderno1->marca = "Tilibra";
$Caderno1->numeroDePaginas = 100;
$Caderno1->cor = "Azul";
$Caderno1->formato = "A4";
$Caderno1->tipoDeCapa = "Dura";
echo $Caderno1->Abrir() . "<br>";

$Caderno2 = new Caderno();
$Caderno2->marca = "Jandaia";
$Caderno2->numeroDePaginas = 200;
$Caderno2->cor = "Vermelho";
$Caderno2->formato = "A5";
$Caderno2->tipoDeCapa = "Flexível";
echo $Caderno2->Escrever() . "<br>";

$Caderno3 = new Caderno();
$Caderno3->marca = "Foroni";
$Caderno3->numeroDePaginas = 150;
$Caderno3->cor = "Verde";
$Caderno3->formato = "A4";
$Caderno3->tipoDeCapa = "Dura";
echo $Caderno3->Fechar() . "<br>";

class Mochila {
    public $marca;
    public $cor;
    public $capacidade;
    public $numeroDeCompartimentos;
    public $material;
    
    public function Abrir() {
        return "A mochila " . $this->marca . " está aberta.";
    }

    public function Guardar() {
        return "Guardando itens na mochila " . $this->marca . ".";
    }

    public function Fechar() {
        return "A mochila " . $this->marca . " está fechada.";
    }
}

echo "<h4>Class Mochila</h4>";
$Mochila1 = new Mochila();
$Mochila1->marca = "Nike";
$Mochila1->cor = "Preta";
$Mochila1->capacidade = "20L";
$Mochila1->numeroDeCompartimentos = 3;
$Mochila1->material = "Poliéster";
echo $Mochila1->Abrir() . "<br>";

$Mochila2 = new Mochila();
$Mochila2->marca = "Adidas";
$Mochila2->cor = "Azul";
$Mochila2->capacidade = "25L";
$Mochila2->numeroDeCompartimentos = 4;
$Mochila2->material = "Nylon";
echo $Mochila2->Guardar() . "<br>";

$Mochila3 = new Mochila();
$Mochila3->marca = "Puma";
$Mochila3->cor = "Vermelha";
$Mochila3->capacidade = "30L";
$Mochila3->numeroDeCompartimentos = 5;
$Mochila3->material = "Couro Sintético";
echo $Mochila3->Fechar() . "<br>";

?>