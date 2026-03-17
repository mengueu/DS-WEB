function velocidade(modo) {
    fetch("funcao.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "modo=" + modo
    });
}