<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

$pageTitle = 'Tasks';
$userId = $_SESSION['user_id'];
$success = '';

// Handle task actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_task'])) {
        $stmt = $pdo->prepare("
            INSERT INTO tasks (user_id, title, description, due_date, priority) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $userId,
            $_POST['title'],
            $_POST['description'] ?? '',
            $_POST['due_date'] ?: null,
            $_POST['priority']
        ]);
        $success = 'Task added successfully!';
    } elseif (isset($_POST['delete_task'])) {
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE task_id = ? AND user_id = ?");
        $stmt->execute([$_POST['task_id'], $userId]);
        $success = 'Task deleted successfully!';
    }
}

// Get all tasks
$tasks = getTasks($pdo, $userId);

include 'templates/dashboard-header.php';
include 'templates/tasks-content.php';
include 'templates/dashboard-footer.php';
?>