<?php
// api/get_cart.php
session_start(); 

header('Content-Type: application/json');

require_once '../includes/db_connect.php';

try {
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        echo json_encode([]); 
        exit();
    }

    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("
        SELECT
            ci.product_id AS id,        -- ID del prodotto nel carrello
            p.name AS NAME,            -- Nome del prodotto (aliased a NAME per coerenza con il tuo JS)
            p.price,                   -- Prezzo del prodotto
            p.image AS image,      -- URL dell'immagine del prodotto (aliased a image per coerenza con il tuo JS)
            ci.quantity                -- Quantità dell'articolo nel carrello
        FROM
            cart_items ci
        JOIN
            products p ON ci.product_id = p.id
        WHERE
            ci.user_id = :userId
        ORDER BY
            p.name ASC; 
    ");

    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    
    $stmt->execute();
    
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cartItems);

} catch (PDOException $e) {
    error_log("Errore nel recupero del carrello database: " . $e->getMessage()); 
    echo json_encode(['success' => false, 'message' => 'Errore del server nel recupero del carrello. Riprova più tardi.']);
}

?>