<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || $_SESSION['role'] !== 'admin') {
    http_response_code(401);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['user_id']) && $data['user_id'] != $_SESSION['user_id']) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$data['user_id']]);
    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid data or cannot delete yourself']);
}
?>