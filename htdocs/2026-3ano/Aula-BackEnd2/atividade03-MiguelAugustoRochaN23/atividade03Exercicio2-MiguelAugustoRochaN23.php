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
        return $this->artista->nome . " | Duração: " . $this->duracao . "<br>Artista: " . $this->artista->nome . " | Gênero: " . $this->artista->genero;
    }
}

$artista = new Artista("Veigh", "Trap");

$musica = new Musica("Talvez você precise de mim", "5:39", $artista);

echo $musica->exibirInfo();

?>