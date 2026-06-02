<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    http_response_code(401);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['task_id']) && isset($data['status'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE task_id = ? AND user_id = ?");
    $stmt->execute([$data['status'], $data['task_id'], $_SESSION['user_id']]);
    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}
?>