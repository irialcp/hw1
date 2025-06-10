document.addEventListener('DOMContentLoaded', () => {
    const logoutIcon = document.getElementById('logout-icon');

    if (logoutIcon) {
        logoutIcon.addEventListener('click', async (event) => {
            event.preventDefault(); // Impedisce il comportamento di default del link (es. navigazione a #)

            try {
                // Effettua una richiesta al tuo script PHP di logout
                const response = await fetch('/storror_clone/logout.php', {
                    method: 'POST', // O 'GET', ma POST è più sicuro per azioni che modificano lo stato
                    headers: {
                        'Content-Type': 'application/json'
                    }
                    // Non inviamo un body, poiché il logout non richiede dati specifici
                });

                const result = await response.json();

                if (result.success) {
                    // Logout riuscito, reindirizza alla homepage o alla pagina di login
                    window.location.href = '/storror_clone/index.php'; // O '/storror_clone/login.php'
                } else {
                    // C'è stato un errore nel logout (es. sessione già terminata)
                    console.error('Errore durante il logout:', result.message);
                    alert('Impossibile effettuare il logout: ' + result.message);
                    // Potresti voler reindirizzare comunque l'utente se l'API dice che non è loggato
                    if (result.message === 'Utente non autenticato') { // Esempio di messaggio dall'API logout.php
                        window.location.href = '/storror_clone/index.php';
                    }
                }
            } catch (error) {
                console.error('Errore di rete durante il logout:', error);
                alert('Si è verificato un errore di rete. Riprova più tardi.');
            }
        });
    }
});