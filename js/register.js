document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('register-form');
    const registrationStatusMessage = document.getElementById('registration-status-message');

    if (registerForm) {
        registerForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirm_password = document.getElementById('confirm_password').value;

            if (registrationStatusMessage) {
                registrationStatusMessage.textContent = '';
                registrationStatusMessage.style.color = '';
            } else {
                console.error("Errore: Elemento con ID 'registration-status-message' non trovato nel DOM.");
                return;
            }

            if (password !== confirm_password) {
                registrationStatusMessage.textContent = 'Le password non corrispondono.';
                registrationStatusMessage.style.color = 'red';
                return;
            }

            if (password.length < 8) {
                registrationStatusMessage.textContent = 'La password deve essere lunga almeno 8 caratteri.';
                registrationStatusMessage.style.color = 'red';
                return;
            }

            if (!/[A-Z]/.test(password)) {
                registrationStatusMessage.textContent = 'La password deve contenere almeno una maiuscola.';
                registrationStatusMessage.style.color = 'red';
                return;
            }

            if (!/[0-9]/.test(password)) {
                registrationStatusMessage.textContent = 'La password deve contenere almeno un numero.';
                registrationStatusMessage.style.color = 'red';
                return;
            }


            try {
                const response = await fetch('/storror_clone/api/register_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: username,
                        email: email,
                        password: password,
                        confirm_password: confirm_password 
                    })
                });

                if (!response.ok) {
                    console.error('Errore HTTP:', response.status, response.statusText);
                    registrationStatusMessage.textContent = 'Si è verificato un errore del server. Riprova più tardi.';
                    registrationStatusMessage.style.color = 'red';
                    return;
                }

                const result = await response.json();

                if (result.success) {
                    registrationStatusMessage.textContent = result.message;
                    registrationStatusMessage.style.color = 'green';
                    setTimeout(() => {
                        window.location.href = '/storror_clone/index.php';
                    }, 1000);
                    registerForm.reset();
                } else {
                    registrationStatusMessage.textContent = result.message;
                    registrationStatusMessage.style.color = 'red';
                }
            } catch (error) {
                console.error('Errore durante la registrazione (catch generale):', error);
                registrationStatusMessage.textContent = 'Si è verificato un errore di rete o di elaborazione. Riprova più tardi.';
                registrationStatusMessage.style.color = 'red';
            }
        });
    }
});