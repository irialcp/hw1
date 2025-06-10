document.addEventListener('DOMContentLoaded', function() {
    loadCarouselContent(); 
});

async function loadCarouselContent() {
    const carouselContainer = document.getElementById('dynamic-carousel');

    if (!carouselContainer) {
        console.warn("Element with ID 'dynamic-carousel' not found. Carousel content won't load.");
        return;
    }

    const apiUrl = 'api/get_carousel_items.php'; 

    try {
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const carouselItems = await response.json();

        if (!Array.isArray(carouselItems) || carouselItems.length === 0) {
            console.warn("No carousel items received or data is empty.");
            carouselContainer.innerHTML = "<p style='text-align: center; color: #bbb;'>Nessun contenuto disponibile al momento.</p>";
            return;
        }

        let htmlContent = '';
        carouselItems.forEach(item => {
            if (item.image) {
                htmlContent += `
                    <div class="carousel-container">
                        <a href="shop.php" target="_blank" aria-label="Visita il prodotto"> 
                            <img src="${item.image}" alt="Immagine prodotto Storror">
                        </a>
                    </div>
                `;
            } else {
                console.warn("Carousel item has no image URL:", item);
            }
        });

        carouselContainer.innerHTML = htmlContent;

    } catch (error) {
        console.error('Errore durante il caricamento dei contenuti del carosello:', error);
        carouselContainer.innerHTML = "<p style='text-align: center; color: red;'>Impossibile caricare i contenuti. Riprova più tardi.</p>";
    }

    const bottone = document.getElementById('image_button');
const imageMenuWrap = document.querySelector("#parkour_images_menu");

bottone.addEventListener('click', () => {
    imageMenuWrap.classList.toggle("active");
    if (overlay) {
        overlay.classList.toggle("active");
    }
    
    cercaImmaginiParkour();
});

const UNSPLASH_KEY = "secret";

function cercaImmaginiParkour() {
    fetch('https://api.unsplash.com/search/photos?query=parkour&per_page=5', {
        headers: {
            Authorization: `Client-ID ${UNSPLASH_KEY}`
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Errore nella chiamata a Unsplash');
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('parkour_images');
        container.innerHTML = ''; 
        for (let i = 0; i < data.results.length; i++) {
            const foto = data.results[i];
            const img = document.createElement('img');
            img.src = foto.urls.small;
            img.alt = foto.alt_description;
            container.appendChild(img);
        }
    })
    .catch(error => {
        console.error('Errore API Unsplash:', error);
    });
}
closeOnClickOutside([bottone], imageMenuWrap, overlay);
}