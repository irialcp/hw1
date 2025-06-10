document.addEventListener('DOMContentLoaded', () => {

    let lastScroll = 0;
    const header = document.querySelector("#header");
    const scrollThreshold = 10;
    let ticking = false; 

    if (header) {
        window.addEventListener("scroll", function() {
            if(!ticking){
                window.requestAnimationFrame(function() {
                    const currentScroll = window.scrollY;
                    const headerHeight = header.offsetHeight; 

                    if (currentScroll < lastScroll && currentScroll > scrollThreshold) {
                        header.style.top = "0";
                    } else if (currentScroll > lastScroll && currentScroll > headerHeight) {
                        header.style.top = `-${headerHeight}px`;
                    }

                    if (currentScroll < scrollThreshold) {
                        header.style.top = "0";
                    }

                    lastScroll = currentScroll;
                    ticking = false;
                });
                ticking = true;
            }
        });
    } else {
        console.warn("Elemento #header non trovato. La funzionalità di scroll dell'header non sarà attiva.");
    }

    const logoutButton = document.getElementById('logout_button');
    const logoutButtonDesktop = document.getElementById('logout_button_desktop');

    if (logoutButton) {
        logoutButton.addEventListener('click', async (event) => {
            event.preventDefault();
            try {
                const response = await fetch('/storror_clone/logout.php', { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const result = await response.json();
                if (result.success) {
                    window.location.href = '/storror_clone/index.php';
                } else {
                    console.error('Errore durante il logout:', result.message);
                    alert('Si è verificato un errore durante il logout. Riprova.');
                }
            } catch (error) {
                console.error('Errore di rete durante il logout:', error);
                alert('Si è verificato un errore di rete durante il logout. Riprova più tardi.');
            }
        });
    }

    if (logoutButtonDesktop) {
        logoutButtonDesktop.addEventListener('click', async (event) => {
            event.preventDefault();
            try {
                const response = await fetch('/storror_clone/logout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });
                const result = await response.json();
                if (result.success) {
                    window.location.href = '/storror_clone/index.php';
                } else {
                    console.error('Errore durante il logout:', result.message);
                    alert('Si è verificato un errore durante il logout. Riprova.');
                }
            } catch (error) {
                console.error('Errore di rete durante il logout:', error);
                alert('Si è verificato un errore di rete durante il logout. Riprova più tardi.');
            }
        });
    }


    const menuButton = document.querySelector("#menu_button");
    const menuWrap = document.querySelector("#wrapper");
    const menuClose = document.querySelector("#close");
    const overlay = document.querySelector(".overlay");

    function openMenu() {
        if (menuWrap) menuWrap.classList.add("active");
        if (overlay) overlay.classList.add("active");
    }

    function closeMenu() {
        if (menuWrap) menuWrap.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
    }

    if (menuButton) {
        menuButton.addEventListener("click", openMenu);
    }

    if (menuClose) {
        menuClose.addEventListener("click", closeMenu);
    }

    if (overlay) {
        overlay.addEventListener("click", closeMenu);
    }

    const imageButton = document.getElementById('image_button');
    const parkourImagesMenu = document.querySelector("#parkour_images_menu");
    const UNSPLASH_KEY = "YOUR_UNSPLASH_API_KEY_HERE";

    if (imageButton && parkourImagesMenu && overlay) {
        imageButton.addEventListener('click', () => {
            parkourImagesMenu.classList.add("active");
            overlay.classList.add("active");
            cercaImmaginiParkour();
        });

        overlay.addEventListener('click', () => {
            if (parkourImagesMenu.classList.contains('active')) {
                parkourImagesMenu.classList.remove('active');
                overlay.classList.remove('active');
            }
        });
    } else {
        
    } 

    const chatButton = document.querySelector("#chat_button");
    const chatContainer = document.querySelector("#chat_container");
    const chatInput = document.getElementById('chat_input');
    const chatSendButton = document.getElementById('chat_send_button');
    const chatMessages = document.getElementById('chat_messages');
    const CHATGPT_API_KEY = 'YOUR_CHATGPT_API_KEY_HERE';

    if (chatButton && chatContainer && overlay) {
        chatButton.addEventListener('click', () => {
            chatContainer.classList.add("active");
            overlay.classList.add("active");
        });

        overlay.addEventListener('click', () => {
            if (chatContainer.classList.contains('active')) {
                chatContainer.classList.remove('active');
                overlay.classList.remove('active');
            }
        });

        if (chatInput && chatSendButton && chatMessages) {
            chatSendButton.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    sendMessage();
                }
            });
        }
    } else {
        console.warn("Elementi per la chat (chat_button, chat_container) non trovati. Funzionalità chat limitata.");
    }

    function appendMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', sender);
        messageElement.textContent = message;
        if (chatMessages) {
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    async function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        appendMessage('user', message);
        chatInput.value = '';

        if (CHATGPT_API_KEY === "YOUR_CHATGPT_API_KEY_HERE") {
            appendMessage('bot', "ATTENZIONE: Chiave API ChatGPT non configurata. Non posso rispondere.");
            console.error("ATTENZIONE: Chiave API ChatGPT non configurata.");
            return;
        }

        try {
            const response = await fetch('https://api.openai.com/v1/chat/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${CHATGPT_API_KEY}`
                },
                body: JSON.stringify({
                    model: "gpt-3.5-turbo",
                    messages: [{ role: "user", content: message }],
                    max_tokens: 150
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(`API Error: ${response.status} - ${errorData.error.message}`);
            }

            const data = await response.json();
            const botReply = data.choices[0].message.content;
            appendMessage('bot', botReply);

        } catch (error) {
            console.error("Errore API ChatGPT:", error);
            appendMessage('bot', `Errore nella chiamata API: ${error.message}. Riprova più tardi.`);
        }
    }
});