<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STORROR</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js" defer></script>
</head>
<body class="login-page">
    <header>
        <div>
            <a href="index.php"><img src="public/logo.png" alt="STORROR Logo"></a>
        </div>
    </header>

    <div class="login-content-wrapper">
        <form id="login-form">
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
            <button type="submit">Accedi</button>
        </form>
        <p id="login-message" style="color: red; margin-top: 10px;"></p>
        <span>Non sei registrato? <a href="/storror_clone/register.php"> Clicca qui</a></span>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>