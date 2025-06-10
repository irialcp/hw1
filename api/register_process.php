<?php
session_start();
require_once '../includes/db_connect.php'; 

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$username = trim($input['username'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';
$confirm_password = $input['confirm_password'] ?? '';

if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    echo json_encode(['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'Le password non corrispondono.']);
    exit;
}
if (strlen($password) < 8) {
    echo json_encode(['success' => false, 'message' => 'La password deve essere lunga almeno 8 caratteri.']);
    exit;
}

if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
    echo json_encode(['success' => false, 'message' => 'La password deve contenere almeno una maiuscola e un numero.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Formato email non valido.']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Nome utente già in uso. Scegli un altro.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email già registrata. Accedi o usa un\'altra email.']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        echo json_encode(['success' => true, 'message' => 'Registrazione completata con successo! Ora sei loggato.', 'loggedIn' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione. Riprova.']);
    }

} catch (PDOException $e) {
    error_log("Errore di registrazione database: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Si è verificato un errore del server. Riprova più tardi.']);
}

?>