// Aplica o tema salvo assim que a página carregar
window.addEventListener("DOMContentLoaded", function () {
    const temaSalvo = localStorage.getItem("tema");
    const botao = document.querySelector(".tema");

    if (temaSalvo === "escuro") {
        document.body.classList.add("escuro");
    }

    atualizarIcone(botao);
});

// Alterna o tema e salva no navegador
function alternarTema() {
    const botao = document.querySelector(".tema");

    document.body.classList.toggle("escuro");

    if (document.body.classList.contains("escuro")) {
        localStorage.setItem("tema", "escuro");
    } else {
        localStorage.setItem("tema", "claro");
    }

    atualizarIcone(botao);
}

// Atualiza o emoji do botão
function atualizarIcone(botao) {
    if (!botao) return;

    if (document.body.classList.contains("escuro")) {
        botao.textContent = "Alterar Tema ☀︎";
    } else {
        botao.textContent = "Alterar Tema ☽";
    }
}