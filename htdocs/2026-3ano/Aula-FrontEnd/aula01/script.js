var nome = "Miguel" //var: variável global
const PI = 3.14 //Constante
let numero = Number(10) //let: variável local

alert(nome) // alert Exibe uma caixa de diálogo no navegador
console.log(numero * PI) // console.log Coloca informações no console do navegador

let inteiro = Number.parseInt("20") //Converte string para inteiro
let float = Number.parseFloat("10.5") //Converte string para float
let str = String(100) //Converte número para string

let numero1 = 10
console.log(numero1.toFixed(2)) // Exibe o número com 2 casas decimais = 10.00

let texto = "Olá, "
let nomeCompleto = texto + nome //Concatenação de strings
console.log(nomeCompleto)

console.log(numero1.toLocaleString) // Formata número conforme a localidade
console.log(numero1.toLocaleString("pt-BR", {style: "currency", currency: "BRL"})) // Formata número como moeda brasileira

window.alert("Bem-vindo, " + nome) // Exibe uma caixa de diálogo com mensagem personalizada

var resposta = window.confirm("Deseja continuar?") // Exibe uma caixa de diálogo com opções OK e Cancelar
console.log("Resposta: " + resposta)

let apagar = confirm("Deseja apagar o arquivo?") // Exibe uma caixa de diálogo com opções OK e Cancelar
if (apagar) {
    console.log("Arquivo apagado.")
    document.body.innerHTML = "<h1>Arquivo apagado com sucesso!</h1>" // Modifica o conteúdo HTML da página
} else {
    console.log("Operação cancelada.")
    document.body.innerHTML = "<h1>Operação cancelada!</h1>"
}

var seunome = window.prompt("Qual é o seu nome?") // Exibe uma caixa de diálogo para entrada de texto
if (seunome) {
    console.log("Olá, " + seunome + "!") // Outro tipo de concatenação
} else {
    console.log("Você cancelou ou não digitou nada.")
}

var calculadora = window.prompt("Digite uma operação matemática (ex: 2 + 2):") // Solicita uma operação matemática porém o resultado é uma string
var resultado = eval(calculadora) // Avalia a expressão matemática
if (resultado) {
    console.log("O resultado é: " + resultado)
} else {
    console.log("Operação inválida ou cancelada.")
}

