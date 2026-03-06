<?php
    class Artista {
        public $nome;
        public $genero;

        public function __construct($novoNome, $novoGenero) {
            $this->nome = $novoNome;
            $this->genero = $novoGenero;
        }
    }
    class Musica {
        public $titulo;
        public $duracao;
        public Artista $artista;

        public function __construct($novoTitulo, $novaDuracao, Artista $novoArtista) {
            $this->titulo = $novoTitulo;
            $this->duracao = $novaDuracao;
            $this->artista = $novoArtista;
        }

        public function exibirInfo() {
            return $this->titulo . " | Duração: " . $this->duracao . "<br>Artista: " . $this->artista->nome . " | Gênero: " . $this->artista->genero;
        }
    }

$artista = new Artista("Queen", "Rock");
$musica = new Musica("Bohemian Rhapsody", "5:55", $artista);

echo $musica->exibirInfo();
?>