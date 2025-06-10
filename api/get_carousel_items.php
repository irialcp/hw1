<?php
// api/get_carousel_items.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/db_connect.php';

header('Content-Type: application/json');

try{
    $stmt = $conn->prepare("SELECT image FROM products order by id asc");
    $stmt->execute();
    $carouselItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($carouselItems);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>