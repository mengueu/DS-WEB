let porta;
let escritor;

// Configurações e caracteres de comando (Maiúsculas = Ligar / Minúsculas = Desligar)
const comodos = {
    sala: { ligado: false, cmdLigar: 'S', cmdDesligar: 's' },
    cozinha: { ligado: false, cmdLigar: 'C', cmdDesligar: 'c' },
    dormitorio: { ligado: false, cmdLigar: 'D', cmdDesligar: 'd' },
    banheiro: { ligado: false, cmdLigar: 'B', cmdDesligar: 'b' }
};

const btnConectar = document.getElementById('btnConectar');
const txtStatus = document.getElementById('status');

// Lógica de Conexão Serial USB
btnConectar.addEventListener('click', async () => {
    if ('serial' in navigator) {
        try {
            porta = await navigator.serial.requestPort();
            await porta.open({ baudRate: 9600 });
            escritor = porta.writable.getWriter();
            
            txtStatus.innerText = "Status: Conectado com sucesso!";
            txtStatus.className = "conectado";
            btnConectar.style.display = 'none';
        } catch (erro) {
            txtStatus.innerText = "Falha ao conectar: " + erro.message;
        }
    } else {
        alert("O seu browser não suporta nativamente a Web Serial API. Por favor, use o Google Chrome ou Microsoft Edge atualizados.");
    }
});

// Configuração de Cliques nas divisões
Object.keys(comodos).forEach(id => {
    const bgClicavel = document.getElementById(`bg-${id}`);
    const grupoComodo = document.getElementById(`group-${id}`);

    bgClicavel.addEventListener('click', async () => {
        if (!escritor) {
            alert("Primeiro, clique no botão 'Conectar ao Arduino' no topo da página!");
            return;
        }

        // Alternar estado interno
        comodos[id].ligado = !comodos[id].ligado;

        // Modificar classe css e enviar byte de comando
        if (comodos[id].ligado) {
            grupoComodo.classList.add('ligado');
            await enviarComando(comodos[id].cmdLigar);
        } else {
            grupoComodo.classList.remove('ligado');
            await enviarComando(comodos[id].cmdDesligar);
        }
    });
});

async function enviarComando(char) {
    if (escritor) {
        const encoder = new TextEncoder();
        await escritor.write(encoder.encode(char));
    }
}