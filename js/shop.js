// js/shop.js
document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
});

async function loadProducts() {
    const productContainer = document.getElementById('product-list');
    if (!productContainer) {
        console.error("Elemento con ID 'product-container' non trovato. Impossibile caricare i prodotti.");
        return;
    }

    const apiUrl = '/storror_clone/api/get_products.php'; // URL dell'API per i prodotti

    try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error(`Errore HTTP! Stato: ${response.status}`);
        }
        
        const products = await response.json();

        if (!products || !Array.isArray(products) || products.length === 0) {
            console.warn("Nessun prodotto trovato o dati vuoti dall'API.");
            productContainer.innerHTML = "<p style='text-align: center; color: #bbb;'>Nessun prodotto disponibile al momento.</p>";
            return;
        }

        let htmlContent = ''; 
        products.forEach(product => {    
        
            if (product && product.NAME) {
                htmlContent += `
                    <div class="product-card">
                        <div class="product-card__image"> 
                            <a href="product.php?id=${product.id}"></a>
                            <img class="main-image" src="${product.image}" alt="${product.NAME}">
                            <img class="hover-image" src="${product.image_hover}" alt="${product.NAME}" >
                            <button class="add-to-cart" data-id="${product.id}">+ Add</button>
                        </div>
                        <h3>${product.NAME}</h3>
                        <p>${product.color || ''}</p> 
                        <span class="price">€${parseFloat(product.price).toFixed(2)}</span>
                        
                    </div>
                `;
            } else {
                console.warn("Prodotto non valido o senza nome trovato, saltato:", product);
            }
        });

        productContainer.innerHTML = htmlContent;

        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 
                const productId = this.dataset.id; 
                addToCart(productId); 
            });
        });

    } catch (error) {
        console.error('Errore nel caricamento dei prodotti:', error);
        productContainer.innerHTML = "<p style='text-align: center; color: red;'>Errore nel caricamento dei prodotti. Riprova più tardi.</p>";
    }
}
/**
 * @param {string} productId - L'ID del prodotto da aggiungere.
 */
async function addToCart(productId) {
    try {
        const response = await fetch('/storror_clone/api/insert_cart.php', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Prodotto aggiunto al carrello!');
        } else {
            if (result.message === 'Utente non autenticato.') { 
                alert('Devi effettuare il login per aggiungere prodotti al carrello.');
                window.location.href = '/storror_clone/login.php'; 
            } else {
                alert('Errore: ' + result.message);
            }
        }
    } catch (error) {
        console.error('Errore durante l\'aggiunta al carrello:', error);
        alert('Si è verificato un errore durante l\'aggiunta al carrello.');
    }
}