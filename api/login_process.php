<?php
session_start();

header('Content-Type: application/json');

require_once '../includes/db_connect.php'; 

$input = json_decode(file_get_contents('php://input'), true);

$username = trim($input['username'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Nome utente, email e password sono richiesti.', 'loggedIn' => false]);
    exit();
}

try {
   
    $stmt = $conn->prepare("SELECT id, username, email, password_hash FROM users WHERE username = :username AND email = :email LIMIT 1");
    
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $user = $stmt->fetch(); 

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Nome utente o email non corrispondenti.', 'loggedIn' => false]);
        exit();
    }

    if (password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email']; 
        $_SESSION['logged_in'] = true;

        echo json_encode(['success' => true, 'message' => 'Login effettuato con successo.', 'loggedIn' => true]);
    } else {

        echo json_encode(['success' => false, 'message' => 'Password errata.', 'loggedIn' => false]);
    }

} catch (PDOException $e) {
    error_log("Errore di login database: " . $e->getMessage()); 
    echo json_encode(['success' => false, 'message' => 'Si è verificato un errore del server. Riprova più tardi.', 'loggedIn' => false]);
}

?>