<?php
    class Documento{
        private $numero;
        public function getNumero()
        {
            return $this->numero;
        }
        public function setNumero($numero)
        {
            $this->numero = $numero;
        }
    }
    class CPF extends Documento{
        public function validar(){
            $cpf = preg_replace('/[^0-9]/', '', $this->getNumero());

            if (strlen($cpf) != 11) {
                return false;
            }

            if (preg_match('/^(\d)\1{10}$/', $cpf)) {
                return false;
            }

            for ($t = 9; $t < 11; $t++) {
                $soma = 0;

                for ($i = 0; $i < $t; $i++) {
                    $soma += $cpf[$i] * (($t + 1) - $i);
                }

                $digito = (10 * $soma) % 11;
                $digito = ($digito == 10) ? 0 : $digito;

                if ($cpf[$t] != $digito) {
                    return false;
                }
            }
            return true;
        }
    }

$cpf = new CPF();
$cpf->setNumero("111.222.333-44");

echo "CPF: " . $cpf->getNumero() . "<br>";
if ($cpf->validar()) {
    echo "Status: válido";
} else {
    echo "Status: inválido";
}

echo "<br><br>";

$cpf2 = new CPF();
$cpf2->setNumero("042.815.546-45");

echo "CPF: " . $cpf2->getNumero() . "<br>";
if ($cpf2->validar()) {
    echo "Status: válido";
} else {
    echo "Status: inválido";
}

?>