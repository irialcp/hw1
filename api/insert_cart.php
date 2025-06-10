<?php
// api/cart.php
session_start(); 

header('Content-Type: application/json');

require_once '../includes/db_connect.php'; 

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
    exit();
}

$userId = $_SESSION['user_id'];

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['product_id']) || !is_numeric($data['product_id'])) {
    echo json_encode(['success' => false, 'message' => 'ID prodotto non valido o mancante.']);
    exit();
}

$productId = (int)$data['product_id'];

try {
    $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) 
                           VALUES (:userId, :productId, 1)
                           ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Prodotto aggiunto al carrello con successo.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'aggiunta al carrello.']);
    }

} catch (PDOException $e) {

    error_log("Errore aggiunta al carrello database: " . $e->getMessage()); 
    echo json_encode(['success' => false, 'message' => 'Si è verificato un errore del server durante l\'aggiunta al carrello. Riprova più tardi.']);
}


?>