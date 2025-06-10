async function loadCart() {
    const cartContainer = document.getElementById('cart-container');
    if (!cartContainer) {
        console.error("Elemento con ID 'cart-container' non trovato. Impossibile caricare il carrello.");
        return;
    }

    const apiUrl = '/storror_clone/api/get_cart.php'; 

    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Errore HTTP!', response.status, errorText);
            cartContainer.innerHTML = `<p style='text-align: center; color: red;'>Errore durante il caricamento del carrello: ${response.status}</p>`;
            return;
        }

        const cartItems = await response.json();
        
        if (!cartItems || !Array.isArray(cartItems) || cartItems.length === 0) {
            console.warn("Nessun articolo nel carrello o dati vuoti dall'API.");
            cartContainer.innerHTML = `
                <p class="empty-cart-message">Il tuo carrello è vuoto. Inizia ad aggiungere prodotti!</p>
                <a href="shop.php" class="button-primary">Torna allo Shop</a>
            `;
            return;
        }

        let htmlItemsContent = '';
        let total_price = 0;

        cartItems.forEach(item => {
            const itemPrice = parseFloat(item.price) || 0; 
            const itemQuantity = parseInt(item.quantity) || 0;

            const subtotal = itemQuantity * itemPrice;
            total_price += subtotal;

            htmlItemsContent += `
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="${item.image ? htmlspecialchars(item.image) : ''}" alt="${item.NAME ? htmlspecialchars(item.NAME) : 'Prodotto'}">
                    </div>
                    <div class="cart-item-details">
                        <h2>${item.NAME ? htmlspecialchars(item.NAME) : 'Nome Prodotto Sconosciuto'}</h2>
                        <p>Prezzo unitario: €${itemPrice.toFixed(2)}</p>
                        <p>Quantità: ${itemQuantity}</p>
                        <p>Subtotale: €${subtotal.toFixed(2)}</p>
                    </div>
                </div>
            `;
        });

        const fullCartHtml = `
            <div class="cart-items-container">
                ${htmlItemsContent}
            </div>
            
            <div class="cart-summary">
                <h2>Totale Carrello: €${total_price.toFixed(2)}</h2>
                <button class="button-primary">Procedi al Checkout</button>
                <a href="shop.php" class="button-secondary">Continua lo Shopping</a>
            </div>
        `;

        cartContainer.innerHTML = fullCartHtml;

    } catch (error) {
        console.error('Errore durante il caricamento del carrello:', error);
        cartContainer.innerHTML = "<p style='text-align: center; color: red;'>Si è verificato un errore durante il caricamento del carrello. Riprova più tardi.</p>";
    }
}

function htmlspecialchars(str) {
    if (typeof str !== 'string') {
        return str;
    }
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return str.replace(/[&<>"']/g, function(m) { return map[m]; });
}

document.addEventListener('DOMContentLoaded', loadCart);