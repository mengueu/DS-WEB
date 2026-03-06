<?php
    class Pessoa{
        public $nome;
        public $idade;

        function getNome(){
            return $this->nome;
        }
        function setNome($n){
            $this->nome = $n;
        }

        function getIdade(){
            return $this->idade;
        }
        function setIdade($i){
            $this->idade = $i;
        }
    }

    class Funcionarios extends Pessoa{
        private $salario;

        function getSalario(){
            return $this->salario;
        }

        function setSalario($s){
            $this->salario = $s;
        }
    }
    
    class Gerente extends Funcionarios{
        function calcularBonus(){
            return $this->getSalario() + $this->getSalario() * 0.2;
        }
    }

    class Desenvolvedor extends Funcionarios{
        function calcularBonus(){
            return $this->getSalario() + $this->getSalario() * 0.1;
        }
    }

$gerente = new Gerente();
$gerente->setNome("Bruno Attina");
$gerente->setIdade(29);
$gerente->setSalario(20000);

echo "Gerente: ";
echo $gerente->getNome() . ", " . $gerente->getIdade() . " anos. Salário: R$" . $gerente->calcularBonus();

echo "<br/> <br/>";

$desenvolvedor = new Desenvolvedor();
$desenvolvedor->setNome("Miguel");
$desenvolvedor->setIdade(17);
$desenvolvedor->setSalario(1000);

echo "Funcionário: ";
echo $desenvolvedor->getNome() . ", " . $desenvolvedor->getIdade() . " anos. Salário: R$" . $desenvolvedor->calcularBonus();
?>