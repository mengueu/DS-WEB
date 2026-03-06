<?php
class Pessoa { // Definição da classe 'Pessoa'
    public $nome; // Atributo público para o nome
    
    public function falar() { // Método público para falar
        return "Olá, meu nome é " . $this->nome; // Retorna uma mensagem com o nome da pessoa
    }
}

$Miguel = new Pessoa(); // Criando um objeto da classe 'Pessoa'
$Miguel->nome = "Miguel Augusto Rocha"; // Atribuindo valor ao atributo nome
echo $Miguel->falar(); // Chamando o método falar e exibindo a mensagem
?>