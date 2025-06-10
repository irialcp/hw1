<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/db_connect.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($products);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
