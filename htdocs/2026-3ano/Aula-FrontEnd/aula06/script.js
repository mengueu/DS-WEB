document.getElementById("form").addEventListener("submit", function (e) {

    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let idade = document.getElementById("idade").value;
    let senha = document.getElementById("senha").value;
    let confirmarSenha = document.getElementById("confirmarSenha").value;
    let pais = document.getElementById("pais").value;
    let data = document.getElementById("data").value;
    let termos = document.getElementById("termos").checked;

    // 1. Campo obrigatório
    if (!nome || !email || !senha) {
        alert("Preencha os campos obrigatórios");
        e.preventDefault();
        return;
    }

    // 2. Tamanho mínimo (senha)
    if (senha.length < 8) {
        alert("A senha deve ter no mínimo 8 caracteres");
        e.preventDefault();
        return;
    }

    // 3. Confirmar senha
    if (senha !== confirmarSenha) {
        alert("As senhas não coincidem");
        e.preventDefault();
        return;
    }

    // 4. Validação de número
    if (idade && isNaN(idade)) {
        alert("Idade deve ser um número");
        e.preventDefault();
        return;
    }

    // 5. Regex (email)
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        alert("Email inválido");
        e.preventDefault();
        return;
    }

    // 6. Select
    if (pais === "") {
        alert("Selecione um país");
        e.preventDefault();
        return;
    }

    // 7. Checkbox
    if (!termos) {
        alert("Você deve aceitar os termos");
        e.preventDefault();
        return;
    }

    // 8. Data
    if (data) {
        let dataDigitada = new Date(data);
        let hoje = new Date();

        if (dataDigitada > hoje) {
            alert("Data não pode ser futura");
            e.preventDefault();
            return;
        }
    }

    alert("Formulário enviado com sucesso!");
});


// 9. Validação em tempo real (email)
document.getElementById("email").addEventListener("input", function () {
    if (this.value.includes("@")) {
        this.style.border = "2px solid green";
    } else {
        this.style.border = "2px solid red";
    }
});