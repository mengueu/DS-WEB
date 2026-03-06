let contadorCadastro = 0;

function validarFormulario(event) {
    event.preventDefault();


    const nome = document.getElementById("nome").value.trim();
    let NomeValidado = true;
    if (nome === "" || nome.length < 3) {
        NomeValidado = false;
        document.getElementById("erro-nome").textContent = "Preencha o nome corretamente!";
        document.getElementById("erro-nome").style.color = "red";
    } else {
        document.getElementById("erro-nome").textContent = "Nome válido.";
        document.getElementById("erro-nome").style.color = "green";
    }

    
    const email = document.getElementById("email").value.trim();
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let EmailValidado = true;
    if (email === "" || !regexEmail.test(email)) {
        EmailValidado = false;
        document.getElementById("erro-email").innerHTML = "Email inválido!<br>Use o formato: xxxxx@xxxx.com";
        document.getElementById("erro-email").style.color = "red";
    } else {
        document.getElementById("erro-email").textContent = "Email válido.";
        document.getElementById("erro-email").style.color = "green";
    }


    const senha = document.getElementById("senha").value;
    const regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    let SenhaValidada = true;
    if (senha === "" || !regexSenha.test(senha)) {
        SenhaValidada = false;
        document.getElementById("erro-senha").innerHTML =
            "Senha inválida! Requisitos:" + "<br>" +
            "- Mínimo de 8 caracteres." + "<br>" +
            "- Pelo menos 1 letra maiúscula." + "<br>" +
            "- Pelo menos 1 letra minúscula." + "<br>" +
            "- Pelo menos 1 número." + "<br>" +
            "- Pelo menos 1 caractere especial.";
        document.getElementById("erro-senha").style.color = "red";
    } else {
        document.getElementById("erro-senha").textContent = "Senha válida.";
        document.getElementById("erro-senha").style.color = "green";
    }

    
    const confirmaSenha = document.getElementById("confirma-senha").value;
    if (confirmaSenha === "" || senha !== confirmaSenha || !SenhaValidada) {
        SenhaValidada = false;
        document.getElementById("erro-confirmasenha").textContent = "Senhas não compatíveis!";
        document.getElementById("erro-confirmasenha").style.color = "red";
    } else {
        document.getElementById("erro-confirmasenha").textContent = "Senhas válidas.";
        document.getElementById("erro-confirmasenha").style.color = "green";
    }

    
    const cpf = document.getElementById("cpf").value.trim();
    const regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
    let CPFValidado = true;
    let cpfNumeros = cpf.replace(/\D/g, "");

    let soma = 0;
    for (let i = 0; i < 9; i++) soma += cpfNumeros[i] * (10 - i);
    let digito1 = (soma * 10) % 11;
    digito1 = digito1 === 10 ? 0 : digito1;

    soma = 0;
    for (let i = 0; i < 10; i++) soma += cpfNumeros[i] * (11 - i);
    let digito2 = (soma * 10) % 11;
    digito2 = digito2 === 10 ? 0 : digito2;

    if (cpf === "" || !regexCPF.test(cpf) || /^(\d)\1+$/.test(cpfNumeros) ||
        digito1 != parseInt(cpfNumeros[9]) || digito2 != parseInt(cpfNumeros[10])) {
        CPFValidado = false;
        document.getElementById("erro-cpf").innerHTML = "CPF inválido!<br>Use o formato: XXX.XXX.XXX-XX";
        document.getElementById("erro-cpf").style.color = "red";
    } else {
        document.getElementById("erro-cpf").textContent = "CPF válido.";
        document.getElementById("erro-cpf").style.color = "green";
    }

    
    const telefone = document.getElementById("telefone").value.trim();
    const regexTelefone = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
    let TelefoneValidado = true;
    if (telefone === "" || !regexTelefone.test(telefone)) {
        TelefoneValidado = false;
        document.getElementById("erro-telefone").innerHTML = "Telefone inválido!<br>Use o formato: (XX) XXXXX-XXXX";
        document.getElementById("erro-telefone").style.color = "red";
    } else {
        document.getElementById("erro-telefone").textContent = "Telefone válido.";
        document.getElementById("erro-telefone").style.color = "green";
    }

    
    const cep = document.getElementById("cep").value.trim();
    const regexCEP = /^\d{5}-\d{3}$/;
    let CEPValidado = true;
    if (cep === "" || !regexCEP.test(cep)) {
        CEPValidado = false;
        document.getElementById("erro-cep").innerHTML = "CEP inválido!<br>Use o formato: 00000-000";
        document.getElementById("erro-cep").style.color = "red";
    } else {
        document.getElementById("erro-cep").textContent = "CEP válido.";
        document.getElementById("erro-cep").style.color = "green";
    }

    
    function validarData() {
        const data = document.getElementById("data-nascimento").value;
        let DataValidado = true;
        if (!data) {
            DataValidado = false;
            document.getElementById("erro-data-nascimento").textContent = "Data não preenchida!";
            document.getElementById("erro-data-nascimento").style.color = "red";
            return DataValidado;
        }
        const [ano, mes, dia] = data.split("-").map(Number);
        const dataObj = new Date(ano, mes - 1, dia);
        if (dataObj.getFullYear() !== ano || dataObj.getMonth() !== mes - 1 || dataObj.getDate() !== dia) {
            DataValidado = false;
            document.getElementById("erro-data-nascimento").textContent = "Data inexistente!";
            document.getElementById("erro-data-nascimento").style.color = "red";
        } else if (ano > 2026) {
            DataValidado = false;
            document.getElementById("erro-data-nascimento").textContent = "Ano não pode ser maior que 2026!";
            document.getElementById("erro-data-nascimento").style.color = "red";
        } else {
            document.getElementById("erro-data-nascimento").textContent = "Data válida.";
            document.getElementById("erro-data-nascimento").style.color = "green";
        }
        return DataValidado;
    }
    let DataValidado = validarData();

    
    const valor = document.getElementById("valor").value.trim();
    let ValorValidado = true;
    function validarValor() {
        const regexValor = /^\d{1,3}(\.\d{3})*,\d{2}$/;
        if (valor === "" || !regexValor.test(valor)) {
            ValorValidado = false;
            document.getElementById("erro-valor").innerHTML = "Valor inválido!<br>Use o formato: 1.299,90";
            document.getElementById("erro-valor").style.color = "red";
            return;
        }
        let numero = parseFloat(valor.replace(/\./g, "").replace(",", "."));
        if (numero < 1 || numero > 1000000) {
            ValorValidado = false;
            document.getElementById("erro-valor").textContent = "Valor deve estar entre 1 e 1000000";
            document.getElementById("erro-valor").style.color = "red";
        } else {
            document.getElementById("erro-valor").textContent = "Valor válido.";
            document.getElementById("erro-valor").style.color = "green";
        }
    }
    validarValor();

    
    const url = document.getElementById("url").value.trim();
    const regexURL = /^(http:\/\/|https:\/\/)/;
    let URLValidado = true;
    if (url === "" || !regexURL.test(url)) {
        URLValidado = false;
        document.getElementById("erro-url").innerHTML = "URL inválida! Deve começar com:<br>- http:// <br>ou  <br>- https://";
        document.getElementById("erro-url").style.color = "red";
    } else {
        document.getElementById("erro-url").textContent = "URL válida.";
        document.getElementById("erro-url").style.color = "green";
    }

    
    const cartao = document.getElementById("cartao").value.trim();
    const regexCartao = /^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/;
    let CartaoValidado = true;
    if (cartao === "" || !regexCartao.test(cartao)) {
        CartaoValidado = false;
        document.getElementById("erro-cartao").textContent = "Número de cartão inválido!";
        document.getElementById("erro-cartao").style.color = "red";
    } else {
        const numero = cartao.replace(/\s/g, "");
        let bandeira = "Desconhecida";
        if (numero.startsWith("4")) bandeira = "Visa";
        else if (/^5[1-5]/.test(numero)) bandeira = "Mastercard";
        else if (/^3[47]/.test(numero)) bandeira = "American Express";
        document.getElementById("erro-cartao").innerHTML = "Cartão válido. <br>Bandeira: " + bandeira;
        document.getElementById("erro-cartao").style.color = "green";
    }

    
    if (NomeValidado && EmailValidado && SenhaValidada &&
        CPFValidado && TelefoneValidado && CEPValidado && DataValidado &&
        ValorValidado && URLValidado && CartaoValidado) {
        AdicionarCadastro();
    }
}


function AdicionarCadastro() {
    const resultado = document.getElementById("resultado");
    let lista = resultado.querySelector("ul");
    if (!lista) lista = document.createElement("ul"), resultado.appendChild(lista);

    contadorCadastro++;

    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const cpf = document.getElementById("cpf").value.trim();
    const telefone = document.getElementById("telefone").value.trim();
    const data = document.getElementById("data-nascimento").value.trim();
    const valor = document.getElementById("valor").value.trim();
    const url = document.getElementById("url").value.trim();
    const cartao = document.getElementById("cartao").value.trim();

    const item = document.createElement("li");
    item.setAttribute("id", "cadastro-" + contadorCadastro);
    item.innerHTML = `
        <strong>Nome:</strong> ${nome} <br>
        <strong>Email:</strong> ${email} <br>
        <strong>CPF:</strong> ${cpf} <br>
        <strong>Telefone:</strong> ${telefone} <br>
        <strong>Data Nascimento:</strong> ${data} <br>
        <strong>Valor:</strong> ${valor} <br>
        <strong>URL:</strong> ${url} <br>
        <strong>Cartão:</strong> ${cartao} <br>
        <hr>
    `;
    lista.appendChild(item);
    document.getElementById("formulario").reset();
}