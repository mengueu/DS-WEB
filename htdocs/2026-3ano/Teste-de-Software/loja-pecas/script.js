let carrinho = [];

function adicionarAoCarrinho(id, nome, preco) {
    let itemExistente = carrinho.find(item => item.id === id);
    
    if (itemExistente) {
        itemExistente.quantidade += 1;
    } else {
        carrinho.push({ id, nome, preco, quantidade: 1 });
    }
    
    atualizarInterfaceCarrinho();
    
    const sidebar = document.getElementById('cart-sidebar');
    if (!sidebar.classList.contains('open')) {
        toggleCart();
    }
}

function atualizarInterfaceCarrinho() {
    const cartItems = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    
    cartItems.innerHTML = '';
    let total = 0;
    let totalItems = 0;
    
    carrinho.forEach(item => {
        // ERRO 1: Erro de lógica matemática. 
        // Em vez de multiplicar (preco * quantidade) para saber o subtotal do item, 
        // o código está somando (preco + quantidade).
        total += item.preco + item.quantidade; 
        
        totalItems += item.quantidade;
        
        cartItems.innerHTML += `
            <div class="cart-item">
                <div class="cart-item-info">
                    <h4>${item.nome}</h4>
                    <p>R$ ${item.preco.toFixed(2)} x ${item.quantidade}</p>
                </div>
            </div>
        `;
    });
    
    cartCount.innerText = totalItems;
    cartTotal.innerText = total.toFixed(2);
}

function toggleCart() {
    document.getElementById('cart-sidebar').classList.toggle('open');
}

function limparCarrinho() {
    carrinho = [];
    atualizarInterfaceCarrinho();
}

function finalizarCompra() {
    if (carrinho.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }
    alert("Sua compra foi efetuada com sucesso!");
    carrinho = [];
    atualizarInterfaceCarrinho();
    toggleCart();
}
