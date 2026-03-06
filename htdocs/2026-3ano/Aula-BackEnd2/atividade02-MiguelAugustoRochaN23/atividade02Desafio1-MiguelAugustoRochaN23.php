<?php
    abstract class Produto{
        public $nome;
        public $preco;
        private $estoque;
        function getNome(){
            return $this->nome;
        }
        function setNome($nome){
            $this->nome = $nome;
        }
        function getPreco(){
            return $this->preco;
        }
        function setPreco($preco){
            $this->preco = $preco;
        }
        function getEstoque(){
            return $this->estoque;
        }
        function setEstoque($estoque){
            $this->estoque = $estoque;
        }
    }
    class Eletronico extends Produto{
        function calcularDesconto(){
            if ($this->getEstoque() < 5) {
                return $this->getPreco() - ($this->getPreco() * 0.2);
            } 
            else {
                return $this->getPreco() - ($this->getPreco() * 0.1);
            }
        }
    }
    
    class Roupas extends Produto{
        function calcularDesconto(){
            if ($this->getEstoque() < 5) {
                return $this->getPreco() - ($this->getPreco() * 0.3);
            } 
            else {
                return $this->getPreco() - ($this->getPreco() * 0.2);
            }
        }
    }

$eletronico = new Eletronico();
$eletronico->setNome("Smartphone");
$eletronico->setPreco(2000);
$eletronico->setEstoque(10);

echo "Produto: " . $eletronico->getNome() . 
"<br> Preço: R$" . $eletronico->getPreco() . 
"<br> Estoque: " . $eletronico->getEstoque() . 
"<br> Preço com desconto: R$" . $eletronico->calcularDesconto();

echo "<br><br>";

$roupa = new Roupas();
$roupa->setNome("Camiseta");
$roupa->setPreco(200);
$roupa->setEstoque(3);

echo "Produto: " . $roupa->getNome() . 
"<br> Preço: R$" . $roupa->getPreco() .
"<br> Estoque: " . $roupa->getEstoque() . 
"<br> Preço com desconto: R$" . $roupa->calcularDesconto();

?>