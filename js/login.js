// js/login.js
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const loginMessage = document.getElementById('login-message');

    if (loginForm) {
        loginForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            const username = loginForm.elements.username.value;
            const email = loginForm.elements.email.value;
            const password = loginForm.elements.password.value;

            loginMessage.textContent = ''; 
            loginMessage.style.color = 'red';

            try {
                const response = await fetch('/storror_clone/api/login_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username: username, email: email, password: password })
                });

                const result = await response.json();

                if (result.success) {
                    loginMessage.textContent = result.message;
                    loginMessage.style.color = 'green';
                    window.location.href = '/storror_clone/shop.php'; 
                } else {
                    loginMessage.textContent = result.message;
                }
            } catch (error) {
                console.error('Errore durante la richiesta di login:', error);
                loginMessage.textContent = 'Si è verificato un errore durante il login. Riprova.';
            }
        });
    }
});