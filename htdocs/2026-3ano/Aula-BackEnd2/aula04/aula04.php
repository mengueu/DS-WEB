<?php
    class Pessoa
    {
        public string $nome; // É possível definir o tipo da variável
        public int $idade;

        public function __construct($novoNome, $novaIdade){ // Método construtor, serve para construir uma função com múltiplos dados
            $this->nome = $novoNome;
            $this->idade = $novaIdade;
        }

        public function exibirDados(){
            return "O nome da pessoa é " . $this->nome . " e a idade é " . $this->idade;
        }

        public function alterarDados($novoNome, $novaIdade){
            $this->nome = $novoNome;
            $this->idade = $novaIdade;
        }
    }

$pessoa = new Pessoa("Carlos", 17);
echo $pessoa->exibirDados();
echo "<br>";
$pessoa->alterarDados("André", 18);
echo $pessoa->exibirDados();

    // Criando um Objeto dentro de um objeto
    class Professor{
        public string $nome;
        public string $email;
        public string $especialidade;
        public function __construct(string $nome, string $email, string $especialidade){
            $this->nome = $nome;
            $this->email = $email;
            $this->especialidade = $especialidade;
        }
    }
    class Turma{
        public string $nome;
        public Professor $professor; // objeto dentro de objeto
        public function __construct(string $nome, Professor $professor){
            $this->nome = $nome;
            $this->professor = $professor;
        }
    }

//Cria o objeto interno PRIMEIRO
$prof = new Professor("Carlos", "carlos@escola.com", "Matemática");
//Passa ele para o objeto externo
$turma = new Turma("3o Ano A", $prof);
//Acessa com -> encadeado
echo $turma->professor->nome; // Carlos
echo $turma->professor->email; // carlos@escola.com
echo $turma->professor->especialidade; // Matemática
?>