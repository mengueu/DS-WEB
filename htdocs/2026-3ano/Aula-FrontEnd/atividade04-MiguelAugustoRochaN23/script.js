var quadrado = document.getElementById("quadrado");
var informacoes = document.getElementById("informacoes");

var tamanho = 100;
var rotacao = 0;
var posicaoX = 0;
var posicaoY = 0;

quadrado.addEventListener("mouseenter", function() { // Entrar para mudar de cor
    quadrado.style.background =
        "rgb(" +
        Math.floor(Math.random()*255) + "," + // Função matemática para gerar um RGB aleatório
        Math.floor(Math.random()*255) + "," +
        Math.floor(Math.random()*255) + ")";
});

quadrado.addEventListener("mouseleave", function() { // Sair para mudar de cor
    quadrado.style.background =
        "rgb(" +
        Math.floor(Math.random()*255) + "," +
        Math.floor(Math.random()*255) + "," +
        Math.floor(Math.random()*255) + ")";
});

quadrado.addEventListener("click", function() { // click aumenta o tamanho do quadrado
    tamanho += 50;
    quadrado.style.width = tamanho + "px";
    quadrado.style.height = tamanho + "px";
});

quadrado.addEventListener("contextmenu", function() { // clique com o botão direito diminui o tamanho do quadrado
    event.preventDefault();
    tamanho -= 50;
    quadrado.style.width = tamanho + "px";
    quadrado.style.height = tamanho + "px";
});

document.addEventListener("keydown", function(event) { // Clicar C para mudar a cor
    if (event.key === "c" || event.key === "C") {
        quadrado.style.background =
            "rgb(" +
            Math.floor(Math.random()*255) + "," + 
            Math.floor(Math.random()*255) + "," +
            Math.floor(Math.random()*255) + ")";
    }

    if (event.key === "t" || event.key === "T") { // Clicar T para aumentar o tamanho
        rotacao += 15;
        quadrado.style.transform = "rotate(" + rotacao + "deg)";
    }

    if (event.key === "r" || event.key === "R") { // Clicar R para resetar o quadrado
        tamanho = 100;
        rotacao = 0;
        posicaoX = 0;
        posicaoY = 0;
        quadrado.style.width = "100px";
        quadrado.style.height = "100px";
        quadrado.style.transform = "rotate(0deg)";
        quadrado.style.left = "0px";
        quadrado.style.top = "0px";
    }

    if (event.key === "ArrowRight") { // Clicar seta direita para mover o quadrado para a direita
        posicaoX += 50;
        quadrado.style.left = posicaoX + "px";
    }

    if (event.key === "ArrowLeft") { // Clicar seta esquerda para mover o quadrado para a esquerda
        posicaoX -= 50;
        quadrado.style.left = posicaoX + "px";
    }

    if (event.key === "ArrowDown") { // Clicar seta para baixo para mover o quadrado para baixo
        posicaoY += 50;
        quadrado.style.top = posicaoY + "px";
    }

    if (event.key === "ArrowUp") { // Clicar seta para cima para mover o quadrado para cima
        posicaoY -= 50;
        quadrado.style.top = posicaoY + "px";
    }

});

window.addEventListener("resize", function() { // Resize da janela para mostrar a largura atual
    informacoes.textContent = "Largura da janela: " + window.innerWidth + "px";
});