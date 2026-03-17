function ligarNET(){
    fetch("ligar.php");
    document.getElementById("estado").textContent = "Status: Ligado";
    document.getElementById("estadoimg").setAttribute("src", "lampadaHIGH.jpg");
}

function desligarNET(){
    fetch("desligar.php");
    document.getElementById("estado").textContent = "Status: Desligado";
    document.getElementById("estadoimg").setAttribute("src", "lampadaLOW.jpg");
}

function piscarNET(){
    fetch("piscar.php");
    document.getElementById("estado").textContent = "Status: Piscando";
    document.getElementById("estadoimg").setAttribute("src", "lampadaHIGH.jpg");
}