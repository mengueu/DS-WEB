function mudarImagem1() {
    document.getElementById("imagem1").setAttribute("src", "imagem2.jpg");
    var valor = document.getElementById("imagem1").getAttribute("src");
    console.log("Valor do atributo src: " + valor);
}
function mudarImagem2() {
    document.getElementById("imagem1").setAttribute("src", "imagem1.jpg");
    var valor = document.getElementById("imagem1").getAttribute("src");
    console.log("Valor do atributo src: " + valor);
}

