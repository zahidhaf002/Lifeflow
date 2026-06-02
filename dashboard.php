<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

$pageTitle = 'Dashboard';
$userId = $_SESSION['user_id'];

// Get today's tasks
$stmt = $pdo->prepare("
    SELECT * FROM tasks 
    WHERE user_id = ? AND status = 'pending' 
    ORDER BY priority DESC, due_date ASC 
    LIMIT 5
");
$stmt->execute([$userId]);
$todaysTasks = $stmt->fetchAll();

// Get today's wellness
$todaysWellness = getTodaysWellness($pdo, $userId);

// Get latest insight
$stmt = $pdo->prepare("
    SELECT * FROM correlation_insights 
    WHERE user_id = ? 
    ORDER BY created_at DESC 
    LIMIT 1
");
$stmt->execute([$userId]);
$insight = $stmt->fetch();

// If no insight, calculate one
if (!$insight) {
    calculateInsights($pdo, $userId);
    $stmt->execute([$userId]);
    $insight = $stmt->fetch();
}

include 'templates/dashboard-header.php';
include 'templates/dashboard-content.php';
include 'templates/dashboard-footer.php';
?>