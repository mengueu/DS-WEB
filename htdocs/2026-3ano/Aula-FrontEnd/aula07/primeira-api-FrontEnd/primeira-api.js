var divResposta = document.getElementById("resposta")

// GET
var botaoHello = document.getElementById("botaoHello")
botaoHello.addEventListener("click", requisicaoHello)

// async = função assícrona: serve para rodar múltiplos processos ao mesmo tempo sem precisar parar o programa em alguma parte
async function requisicaoHello(){
    var requisicao = await fetch('http://localhost/2026-3ano/Aula-BackEnd2/aula06/primeira-api-backend/hello') 
    var resposta = await requisicao.json()
    // await serve para forçar o programa 'esperar' um tempo para processar o comando
    
    console.log("GET:")
    console.log("Status: '" + resposta.status + "'")
    console.log("Mensagem: '" + resposta.message + "'")
    console.log("")

    divResposta.innerHTML = "Status: " + resposta.status + "<br> Mensagem: " + resposta.message
}

// POST
var botaoEcho = document.getElementById("botaoEcho")
botaoEcho.addEventListener("click", requisicaoEcho)

async function requisicaoEcho(){
    var echo = document.getElementById("inputEcho").value

    var requisicao = await fetch('http://localhost/2026-3ano/Aula-BackEnd2/aula06/primeira-api-backend/echo', { // Estou acessando esse caminho
        method: "POST", // Definindo o método POST (por padrão ele fica com GET, por isso tem que definir)
        headers: {"Content-Type": "application/json"}, // Os dados vão ser do tipo json
        body: JSON.stringify({message : echo}) // Vou pegar o conteúdo do input e transformar em informação para enviar
    }) 
    var resposta = await requisicao.json()
    
    console.log("POST:")
    console.log("Status: '" + resposta.status + "'")
    console.log("Mensagem: '" + resposta.echo.message + "'")
    console.log("")

    divResposta.innerHTML = "Status: " + resposta.status + "<br> Mensagem: " + resposta.echo.message
}