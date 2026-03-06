var contadorAluno = 0;
function cadastrarAluno() {
    contadorAluno++;

    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let ra = document.getElementById("ra").value;
    let telefone = document.getElementById("telefone").value;
    let turma = document.getElementById("turma").value;
    let turmaAB = document.getElementById("turmaAB").value;

    if (!validar()) {
        contadorAluno--;
        return;
    }

    document.getElementById("nome").value = "";
    document.getElementById("email").value = "";
    document.getElementById("ra").value = "";
    document.getElementById("telefone").value = "";
    document.getElementById("turma").value = "Fundamental I: 1°ano";
    document.getElementById("turmaAB").value = "A";

    let novoAluno = document.createElement("li");
    novoAluno.setAttribute("id", "aluno" + contadorAluno);

    novoAluno.innerHTML =
    "<strong>Aluno " + contadorAluno + "</strong>" +
    "<ul>" +
    "<li class='dados'><b>Nome:</b> " + nome + "</li>" +
    "<li class='dados'><b>Email:</b> " + email + "</li>" +
    "<li class='dados'><b>RA:</b> " + ra + "</li>" +
    "<li class='dados'><b>Telefone:</b> " + telefone + "</li>" +
    "<li class='dados'><b>Turma:</b> " + turma + " " + turmaAB + "</li>" +
    "</ul>";

    let botaoExcluir = document.createElement("button");
    botaoExcluir.textContent = "Excluir";
    botaoExcluir.setAttribute("class", "excluir");
    botaoExcluir.setAttribute("onclick", "removerAluno(" + contadorAluno + ")");

    novoAluno.appendChild(document.createTextNode(" "));
    novoAluno.appendChild(botaoExcluir);

    document.getElementById("listaAlunos").appendChild(novoAluno);
}
function removerAluno(idAluno) {
    var aluno = document.getElementById("aluno" + idAluno);
    document.getElementById("listaAlunos").removeChild(aluno);
}
function validar() {
    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let ra = document.getElementById("ra").value;
    let telefone = document.getElementById("telefone").value;

    if (nome === "" || email === "" || ra === "" || telefone === "") {
        alert("Por favor, preencha todos os campos.");
        return false;
    }
    return true;
}
