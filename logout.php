<?php
session_start();
session_destroy();
echo json_encode(['success' => true, 'message' => 'Logout effettuato con successo.']);
exit();
?>