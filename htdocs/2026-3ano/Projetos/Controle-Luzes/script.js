const IP_REDE = "127.0.0.1"; // Seu IP de rede local ou localhost para testes
let timersHardware = { 'S': null, 'Q': null };
let timersLog = { 'S': null, 'Q': null };

function registrarAcao(mensagem) {
    const logList = document.getElementById('log-list');
    const li = document.createElement('li');
    
    const now = new Date();
    const dataFormatada = now.toLocaleDateString('pt-BR');
    const horaFormatada = now.toLocaleTimeString('pt-BR', { hour12: false });
    
    li.innerHTML = `<span class="log-time">[${dataFormatada} ${horaFormatada}]</span> ${mensagem}`;
    
    logList.insertBefore(li, logList.firstChild);
    
    if (logList.children.length > 50) {
        logList.removeChild(logList.lastChild);
    }
}

function enviarComandoHardware(letra, valor = "") {
    fetch(`http://${IP_REDE}:8080/?comando=${letra}${valor}`)
        .catch(erro => console.error("Erro ao enviar para o Python:", erro));
}

function atualizarInterfaceSlider(letraComodo, valor, idElemento, idTextoPct, nomeComodo, registrar = true) {
    const elemento = document.getElementById(idElemento);
    const textoPct = document.getElementById(idTextoPct);
    const porcentagem = Math.round((valor / 255) * 100);
    
    textoPct.innerText = `${porcentagem}%`;

    if (valor > 0) {
        elemento.classList.add('aceso');
    } else {
        elemento.classList.remove('aceso');
    }

    clearTimeout(timersHardware[letraComodo]);
    timersHardware[letraComodo] = setTimeout(() => {
        enviarComandoHardware(letraComodo, valor);
    }, 40); 

    if (registrar) {
        clearTimeout(timersLog[letraComodo]);
        timersLog[letraComodo] = setTimeout(() => {
            registrarAcao(`Luminosidade ajustada: ${nomeComodo} para ${porcentagem}%`);
        }, 500);
    }
}

function alternarLuz(idElemento, letraLigar, letraDesligar, nomeComodo, registrar = true) {
    const comodo = document.getElementById(idElemento);
    const statusTxt = comodo.querySelector('.status-luz');
    
    const estaAceso = comodo.classList.contains('aceso');
    
    if (!estaAceso) {
        comodo.classList.add('aceso');
        statusTxt.innerText = "Acesa";
        enviarComandoHardware(letraLigar);
        if(registrar) registrarAcao(`Luz ligada: ${nomeComodo}`);
    } else {
        comodo.classList.remove('aceso');
        statusTxt.innerText = "Apagada";
        enviarComandoHardware(letraDesligar);
        if(registrar) registrarAcao(`Luz desligada: ${nomeComodo}`);
    }
}

function setLuz(idElemento, ligar, letraLigar, letraDesligar) {
    const comodo = document.getElementById(idElemento);
    const statusTxt = comodo.querySelector('.status-luz');
    const estaAceso = comodo.classList.contains('aceso');
    
    if (ligar && !estaAceso) {
        comodo.classList.add('aceso');
        statusTxt.innerText = "Acesa";
        enviarComandoHardware(letraLigar);
    } else if (!ligar && estaAceso) {
        comodo.classList.remove('aceso');
        statusTxt.innerText = "Apagada";
        enviarComandoHardware(letraDesligar);
    }
}

function controlAll(turnOn) {
    const valor = turnOn ? 255 : 0;
    
    const salaSlider = document.querySelector('#sala input');
    salaSlider.value = valor;
    atualizarInterfaceSlider('S', valor, 'sala', 'pct-sala', 'Sala de Estar', false);

    const quartoSlider = document.querySelector('#quarto input');
    quartoSlider.value = valor;
    setTimeout(() => {
        atualizarInterfaceSlider('Q', valor, 'quarto', 'pct-quarto', 'Dormitório', false);
    }, 100);
    
    setTimeout(() => {
        setLuz('cozinha', turnOn, 'C', 'c');
    }, 200);

    setTimeout(() => {
        setLuz('banheiro', turnOn, 'B', 'b');
    }, 300);

    registrarAcao(turnOn ? "Todas as luzes manuais foram LIGADAS." : "Todas as luzes manuais foram DESLIGADAS.");
}

// Lógica de monitoramento do Jardim
let ultimoStatusJardim = null;

function verificarStatusJardim() {
    fetch(`http://${IP_REDE}:8080/?status=jardim`)
        .then(response => response.text())
        .then(data => {
            const jardimDiv = document.getElementById('jardim');
            const statusSpan = document.getElementById('status-jardim');
            
            // Exemplo de retorno esperado do servidor: "Aceso (350)" ou "Apagado (800)"
            const estaAceso = data.startsWith("Aceso");
            statusSpan.innerText = data; // Mostra o status + valor

            if (estaAceso) {
                jardimDiv.classList.add('aceso');
            } else {
                jardimDiv.classList.remove('aceso');
            }

            // Registra no log apenas se o status mudou (ignorando a primeira leitura)
            if (ultimoStatusJardim !== null && ultimoStatusJardim !== estaAceso) {
                registrarAcao(estaAceso ? "Sensor LDR: Jardim acendeu." : "Sensor LDR: Jardim apagou.");
            }
            ultimoStatusJardim = estaAceso;
        })
        .catch(error => {
            console.error("Erro ao verificar jardim:", error);
            document.getElementById('status-jardim').innerText = "Erro";
        });
}

window.onload = () => {
    registrarAcao("Sistema iniciado. Monitoramento web ativo.");
    
    // Inicia a verificação do Jardim a cada 2 segundos
    verificarStatusJardim();
    setInterval(verificarStatusJardim, 2000);
};
