// Funções em JavaScript

function somarNumeros(num1, num2) {
    return num1 + num2;
}
let resultado = somarNumeros(5, 10);
console.log(resultado);

let dataAtual = new Date(); // Cria um objeto Date com a data e hora atuais
console.log("Data atual em inglês: " + dataAtual.toLocaleDateString("en-US")); // Exibe a data atual no formato americano (MM/DD/YYYY)
console.log("Data atual em português: " + dataAtual.toLocaleDateString("pt-BR")); // Exibe a data atual no formato brasileiro (DD/MM/YYYY)
console.log("Data atual no formato ISO: " + dataAtual.toISOString()); // Exibe a data atual no formato ISO (YYYY-MM-DDTHH:mm:ss.sssZ)

let ano = dataAtual.getFullYear(); // Obtém o ano atual
let mes = dataAtual.getMonth() + 1; // Obtém o mês atual (0-11, por isso somamos 1)
let dia = dataAtual.getDate(); // Obtém o dia do mês atual
let horas = dataAtual.getHours(); // Obtém as horas atuais
let minutos = dataAtual.getMinutes(); // Obtém os minutos atuais
let segundos = dataAtual.getSeconds(); // Obtém os segundos atuais
console.log(`Data detalhada (outra concatenação): ${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`); // Concatenação com crase

//Outro exemplo de Date
let hoje = new Date(); // Data atual
let diasParaAdicionar = 7; // Número de dias a adicionar
let novaData = new Date(hoje); // Cria uma nova data baseada na data atual
novaData.setDate(hoje.getDate() + diasParaAdicionar); // Adiciona os dias
console.log(novaData.toLocaleDateString());

// Cálculo de diferença entre datas
let data1 = new Date("2025-03-19");
let data2 = new Date("2025-03-25");
let diferencaMs = data2 - data1;
let diferencaEmDias = diferencaMs / (1000 * 60 * 60 * 24);
console.log(`Diferença em dias: ${diferencaEmDias}`);


// document.getElementById(id): seleciona um elemento pelo seu atributo id.
document.getElementById("id").innerHTML = "ID!"; // Altera o conteúdo do elemento com id "conteudo" na página HTML para exibir "Olá, mundo!" dentro de um parágrafo.
var pegarConteudoid = document.getElementById("id").innerHTML; // Armazena o conteúdo do elemento com id "conteudo" em uma variável.
console.log(pegarConteudoid); // Exibe o conteúdo armazenado na variável no console do navegador.

// document.getElementsByClassName(className): seleciona todos os elementos com a classe especificada. Retorna um HTMLCollection (Array).
document.getElementsByClassName("classe")[0].innerHTML = "Classe!"; 
var pegarConteudoClasse = document.getElementsByClassName("classe")[0].innerHTML;
console.log(pegarConteudoClasse); 

// document.getElementsByTagName(tagName): seleciona todos os elementos com a tag especificada. Retorna um HTMLCollection (Array).
document.getElementsByTagName("p")[0].innerHTML = "Tag!";
var pegarConteudoTag = document.getElementsByTagName("p")[0].innerHTML;
console.log(pegarConteudoTag);

// document.querySelector(selector): seleciona o primeiro elemento que corresponde ao seletor CSS especificado.
document.querySelector(".query").innerHTML = "Query Selector!";
var pegarConteudoQuerySelector = document.querySelector(".query").innerHTML; 
console.log(pegarConteudoQuerySelector);

// document.querySelectorAll(selector): seleciona todos os elementos que correspondem ao seletor CSS especificado. Retorna um NodeList.
document.querySelectorAll("li")[0].innerHTML = "Query Selector All!";
var pegarConteudoQuerySelectorAll = document.querySelectorAll("li")[0].innerHTML; 
console.log(pegarConteudoQuerySelectorAll);

// Manipulação de atributos e estilos

// Foto
document.getElementById("foto").setAttribute("src", "https://www.w3schools.com/images/w3schools_green.jpg"); // Altera o atributo "src" da imagem com id "minha-imagem" para a URL especificada.

// Link
let url = document.getElementById("link").getAttribute("href"); // Armazena o valor do atributo "href" do elemento com id "link" em uma variável.
console.log(url);

// Estilo
document.getElementById("texto").style.backgroundColor = "lightblue"; // Altera a cor de fundo do elemento com id "caixa".

//Adiciona uma classe CSS a um elemento.
document.getElementById("alerta-adicionar").classList.add("adicionar");

//Remove uma classe CSS de um elemento.
document.getElementById("alerta-remover").classList.remove("oculto");

//Criando uma função para um botão
function mudaTamanho() {
    document.getElementById("foto").style.width = "300px";
}
function mudaCor() {
    document.getElementById("texto").style.backgroundColor = "red";
}

// Adicionando e removendo classes
document.getElementById("alerta").classList.add("destaque");