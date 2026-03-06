/* O método addEventListener() é a forma mais moderna e recomendada de capturar e atribuir eventos.
        elemento.addEventListener("tipoDoEvento", funcaoCallback);
*/



// EVENTOS DE MOUSE:

var area = document.getElementById("area");
var mensagem = document.getElementById("mensagem");
var coordenadas = document.getElementById("coordenadas");

// click - Clique simples
area.addEventListener("click", function (){mensagem.textContent = "Clique simples detectado!"; area.style.background = "lightblue";});

// dblclick - Clique duplo
area.addEventListener("dblclick", function(){mensagem.textContent = "Clique Duplo detectado!"; area.style.background = "lightyellow";});

// mouseenter - O mouse entrou na área
area.addEventListener("mouseenter", function(){mensagem.textContent = "O mouse entrou na área!"; area.style.background = "lightgreen";});

// mouseleave - O mouse saiu da área
area.addEventListener("mouseleave", function(){mensagem.textContent = "O mouse saiu da área!"; area.style.background = "red";});

// mousemove - O mouse se moveu dentro da área (exibe as coordenadas)
area.addEventListener("mousemove", function(event){coordenadas.textContent = "X:" + event.clientX + " Y:"+ event.clientY;});

// contextmenu - Clique com o botão direito do mouse (abre o menu de contexto)
area.addEventListener("contextmenu", function(event){
    event.preventDefault(); // preventDefault() impede o comportamento padrão do evento, que neste caso é abrir o menu de contexto
    alert("Botão direito clicado!");
});



// EVENTOS DE TECLADO:

// keydown - Uma tecla foi pressionada
document.addEventListener("keydown", function(event){console.log("Tecla pressionada: " + event.key);});

// keyup - Uma tecla foi liberada
document.addEventListener("keyup", function(event){console.log("Tecla liberada: " + event.key);});

// keypress - Uma tecla foi pressionada e liberada (menos usado, mas ainda suportado em alguns navegadores)
document.addEventListener("keypress", function(event){console.log("Caractere digitado: " + event.key);});

// Exibe a tecla pressionada em um elemento na página (p)
document.addEventListener("keydown", function(event){ 
    var campo = document.getElementById("resultado");
    campo.textContent = "Tecla pressionada (Nome da Tecla): " + event.key; //key
});
document.addEventListener("keydown", function(event){ 
    var campo = document.getElementById("resultado2");
    campo.textContent = "Tecla pressionada (Code): " + event.code; //code
});
document.addEventListener("keydown", function(event){ 
    var campo = document.getElementById("resultado3");
    campo.textContent = "Tecla pressionada (keyCode): " + event.keyCode; //keycode
});



// EVENTOS DE FORMULÁRIO:

var formulario = document.getElementById("meuFormulario");
var selectCurso = document.getElementById("curso");
var nome = document.getElementById("nome");

// submit - O formulário foi enviado
formulario.addEventListener("submit", function(event){
    event.preventDefault(); //Impede o comportamento padrão do navegador
    console.log("Formulário enviado!");
});

// change - O valor de um campo de formulário foi alterado
selectCurso.addEventListener("change", function(){console.log("Curso selecionado: " + selectCurso.value);});

// input - O valor de um campo de formulário está sendo digitado
nome.addEventListener("input", function(){console.log("Digitando: " + nome.value);});

// focus - Um campo de formulário recebeu foco
nome.addEventListener("focus", function(){nome.style.background = "#ffcc00";});

// blur - Um campo de formulário perdeu o foco
nome.addEventListener("blur", function(){nome.style.background = "white";});



// EVENTOS DE JANELA:

// load - A página foi completamente carregada
window.addEventListener("load", function(){console.log("Página totalmente carregada!");});

// scroll - A página foi rolada
window.addEventListener("scroll", function(){console.log("Scroll atual: " + window.scrollY);});

//resize - A janela do navegador foi redimensionada
window.addEventListener("resize", function(){console.log("Nova largura: " + window.innerWidth);});



// REMOVENDO EVENTOS:

function teste() {alert("clicou");}
botao.addEventListener("click", teste);
botao.removeEventListener("click", teste);

