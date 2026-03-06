var capital = prompt("Quanto de dinheiro deseja investir em juros compostos?")
var taxa = prompt("Qual a taxa de juros mensal (em %)?")
var meses = prompt("Por quantos meses o dinheiro ficará investido?")

let montante = Number(capital) * (1 + (Number(taxa) / 100)) ** Number(meses)

alert("O montante após " + meses + " meses será de R$ " + montante.toFixed(2))
console.log("Montante calculado: R$ " + montante.toFixed(2))