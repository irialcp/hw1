<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - STORROR</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/register.css">
    <script src="js/register.js" defer></script>
</head>
<body class="register-page">
    <header>
        <div>
            <a href="index.php"><img src="public/logo.png" alt="STORROR Logo"></a>
        </div>
    </header>

    <div class="registration-content-wrapper">
        <h1>Registrazione</h1>
        <form id="register-form">
            <div class="form-group">
                <label for="username">Nome Utente:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm_password">Conferma Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
            </div>
            <button type="submit">Registrati</button>
        </form>
        <p id="registration-status-message" style="margin-top: 10px;"></p>
        <span>Hai già un account? <a href="/storror_clone/login.php">Accedi qui</a></span>
    </div>

    <?php 
    include 'includes/footer.php'; 
    ?>
</body>
</html>