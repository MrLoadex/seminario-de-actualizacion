<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'No tienes permiso para acceder a esta página.']);
    exit();
}

echo json_encode(['success' => true, 'user' => $_SESSION['username']]);
?>
