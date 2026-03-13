let estado = 3; // 0 = verde, 1 = amarelo, 2 = vermelho, 3 = desligado
let tempos = [1000, 1000, 1000];
let parado = true;
let intervalo;

mostrarCor(estado);

function mostrarCor(cor) {
    if (cor === 0) {
        document.getElementById("vermelho").style.backgroundColor = "#444";
        document.getElementById("amarelo").style.backgroundColor = "#444";
        document.getElementById("verde").style.backgroundColor = "green";
    }
    else if (cor === 1) {
        document.getElementById("vermelho").style.backgroundColor = "#444";
        document.getElementById("amarelo").style.backgroundColor = "yellow";
        document.getElementById("verde").style.backgroundColor = "#444";
    }
    else if (cor === 2) {
        document.getElementById("vermelho").style.backgroundColor = "red";
        document.getElementById("amarelo").style.backgroundColor = "#444";
        document.getElementById("verde").style.backgroundColor = "#444";
    }
    else if (cor === 3) {
        document.getElementById("vermelho").style.backgroundColor = "#444";
        document.getElementById("amarelo").style.backgroundColor = "#444";
        document.getElementById("verde").style.backgroundColor = "#444";
    }
}

function trocar() {
    if (parado) return;
    estado = (estado + 1) % 3;
    mostrarCor(estado);

    clearInterval(intervalo);
    intervalo = setInterval(trocar, tempos[estado]);
}

function iniciar() {
    if (!parado) return; 
    parado = false;
    estado = 2;
    mostrarCor(estado);
    tempos = [1000, 1000, 1000];
    document.getElementById("VelocidadeAtual").textContent = "Velocidade Atual: Normal";

    clearInterval(intervalo);
    intervalo = setInterval(trocar, tempos[estado]);

    fetch("ligar.php", { // envia iniciar para Arduino
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "modo=iniciar" 
    });
}

function parar() {
    parado = true;
    estado = 3;
    mostrarCor(estado);
    document.getElementById("VelocidadeAtual").textContent = "Parado";

    clearInterval(intervalo);

    fetch("ligar.php", { // envia parar para Arduino
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "modo=parar" 
    });
}

function velocidade(tipo) {
    if (tipo === "lento") {
        tempos = [2000, 2000, 2000];
        document.getElementById("VelocidadeAtual").textContent = "Velocidade Atual: Lenta";
    }
    else if (tipo === "medio") {
        tempos = [1000, 1000, 1000];
        document.getElementById("VelocidadeAtual").textContent = "Velocidade Atual: Normal";
    }
    else if (tipo === "rapido") {
        tempos = [500, 500, 500];
        document.getElementById("VelocidadeAtual").textContent = "Velocidade Atual: Rápida";
    }

    clearInterval(intervalo);
    intervalo = setInterval(trocar, tempos[estado]);

    fetch("ligar.php", { // envia 'velocidade' para Arduino
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "modo=" + tipo
    }).then(res => res.text())
      .then(data => console.log(data))
      .catch(err => console.error(err));
}