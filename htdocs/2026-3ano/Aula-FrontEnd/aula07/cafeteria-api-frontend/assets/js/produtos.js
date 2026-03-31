var divResposta = document.getElementById("resposta")
var inputNome   = document.getElementById("nome")
var inputPreco   = document.getElementById("preco")
var selectCategoria   = document.getElementById("categoria")

document.addEventListener('DOMContentLoaded', getProdutos)
document.getElementById('botaoEnviar').addEventListener('click', postProdutos)

// Mostrar categorias em produtos
document.addEventListener('DOMContentLoaded', async() => {
    var requisicao = await fetch("http://localhost/2026-3ano/Aula-BackEnd2/aula07/cafeteria-api-backend/categorias")
    var resposta = await requisicao.json()
    var opcoes = ""

    resposta.data.forEach(categoria => {
        opcoes += `<option value='${categoria.id}'>${categoria.nome}</option>`
        
    });
    selectCategoria.innerHTML = opcoes;
});

async function getProdutos() {
    var requisicao = await fetch("http://localhost/2026-3ano/Aula-BackEnd2/aula07/cafeteria-api-backend/produtos")
    var resposta = await requisicao.json()

    const linhas = resposta.data.map(item => `
        <tr>
            <td>${item.id}</td>
            <td>${item.nome}</td>
            <td>${item.preco}</td>
            <td>${item.categoria_id}</td>
            <td><button onclick="deleteProdutos(${item.id})">Deletar</button></td>
        </tr>
    `).join("");
    
    divResposta.innerHTML = `
        <table class="sua-classe">
            <thead>
                <tr>
                    <th colspan="5" ><center>Produtos Cadastradas</center></th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                ${linhas}
            </tbody>
        </table>
    `;
}

async function postProdutos() {
    var requisicao = await fetch("http://localhost/2026-3ano/Aula-BackEnd2/aula07/cafeteria-api-backend/produtos", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ nome: inputNome.value, preco: inputPreco.value, categorias: selectCategoria})
    })
    var resposta = await requisicao.json()
    console.log(resposta)
    
    inputNome.value = ""
    inputPreco.value = ""

    getProdutos()
}

async function deleteProdutos(id) {
    var requisicao = await fetch("http://localhost/2026-3ano/Aula-BackEnd2/aula07/cafeteria-api-backend/produtos/" + id, {
        method: "DELETE"
    })
 
    var resposta = await requisicao.json()
    console.log(resposta)
 
    getProdutos()
}