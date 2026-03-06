function AdicionatextoEcor() {
    document.getElementById("conteudo").innerHTML = "Texto";
    var pegarTexto = document.getElementById("conteudo").innerHTML;
    console.log(pegarTexto);

    document.getElementById("conteudo").style.color = "green"; 
    var pegarCor = document.getElementById("conteudo").style.color;
    console.log("Cor do texto: " + pegarCor);
}