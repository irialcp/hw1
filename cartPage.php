<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Carrello - STORROR</title>

    <link rel="stylesheet" href="main.css"> 

    <link rel="stylesheet" href="css/cart.css"> 

    <script src="js/cart.js" defer></script> 
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="cart-page-content">
        <h1>Il Mio Carrello</h1>

        <div id="cart-container">
            </div>

    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>