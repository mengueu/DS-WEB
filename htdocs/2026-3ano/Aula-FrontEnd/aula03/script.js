// Adicionando itens a uma lista e removendo itens de uma lista
var contadorItem = 0;
function adicionarItem(){
    contadorItem++; // Incrementa o contador para criar um ID único para cada item adicionado
    console.log(contadorItem);

    let novoItem = document.createElement("li"); // Cria um elemento li e guarda isso em uma variável.
    novoItem.textContent = "Item Novo"; // Adiciona o texto "Item Novo" ao elemento li
    novoItem.setAttribute("id", "item" + contadorItem); // Define o atributo "id" do elemento li como "item1", "item2", etc.
    document.getElementById("item").appendChild(novoItem); // Adiciona o elemento li como filho do elemento com id "item" na página HTML
}
function removerItem(){
    if (contadorItem <= 0) return; // Verifica se há itens para remover, evitando que o contador fique negativo

    var item = document.getElementById("item" + contadorItem);
    if (item) { // Verifica se o item existe antes de tentar removê-lo
        document.getElementById("item").removeChild(item);
        contadorItem--;
    }
}


// Adicionando itens a uma lista COM PROMPT e removendo itens de uma lista
var contadorTarefa = 0;
function adicionarTarefas(){
    contadorTarefa++;

    let novaTarefa = document.createElement("li"); 
    novaTarefa.textContent = prompt("Digite a tarefa:");
    novaTarefa.setAttribute("id", "tarefa" + contadorTarefa);
    document.getElementById("tarefas").appendChild(novaTarefa);
}

function removerTarefas(){
    if (contadorTarefa <= 0) return;

    var tarefa = document.getElementById("tarefa" + contadorTarefa);
    if (tarefa) {
        document.getElementById("tarefas").removeChild(tarefa);
        contadorTarefa--;
    }
}


// Criando uma lista COM BOTÃO DE REMOVER PARA CADA ITEM
var contadorElemento = 0;
function adicionarElemento(){
    contadorElemento++;
    console.log(contadorElemento);

    let elemento = document.createElement("li");
    elemento.textContent = contadorElemento + " - " + prompt("Digite o item:");
    elemento.setAttribute("id", "elemento" + contadorElemento);

    let botaoRemover = document.createElement("button"); // Cria um elemento button
    botaoRemover.textContent = "Remover Elemento";
    botaoRemover.setAttribute("onclick", "removerElemento(" + contadorElemento + ")"); // Define o atributo onclick para chamar a função removerElemento com o ID do item
    elemento.appendChild(document.createTextNode(" ")); // Adiciona um espaço entre o texto e o botão
    elemento.appendChild(botaoRemover);

    document.getElementById("elementos").appendChild(elemento);
}
function removerElemento(elementoLista){ // A variável "elementoLista" recebe o ID do item a ser removido como parâmetro
    var elemento1 = document.getElementById("elemento" + elementoLista);
    document.getElementById("elementos").removeChild(elemento1);
}


// Criando uma lista com botão de remover para cada item e INPUT PARA DIGITAR A TAREFA
var contadorCheckList = 0;
function adicionarCheckList(){
    contadorCheckList++;

    let novaTarefa = document.getElementById("novaTarefa").value; // Obtém o valor do input com id "novaTarefa"

    let elemento2 = document.createElement("li");
    elemento2.textContent = contadorCheckList + " - " + novaTarefa;
    elemento2.setAttribute("id", "checkList" + contadorCheckList);

    let botaoRemover2 = document.createElement("button");
    botaoRemover2.textContent = "Remover Elemento";
    botaoRemover2.setAttribute("onclick", "removerCheckList(" + contadorCheckList + ")"); 
    elemento2.appendChild(document.createTextNode(" "));
    elemento2.appendChild(botaoRemover2);

    document.getElementById("checkList").appendChild(elemento2);
}
function removerCheckList(CheckListLista){
    var elemento3 = document.getElementById("checkList" + CheckListLista);
    document.getElementById("checkList").removeChild(elemento3);
}