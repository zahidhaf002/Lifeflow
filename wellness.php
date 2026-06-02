<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/session.php';
require_once 'includes/functions.php';

$pageTitle = 'Wellness';
$userId = $_SESSION['user_id'];
$success = '';
$error = '';

// Handle wellness logging
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_wellness'])) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO wellness_entries (user_id, entry_date, sleep_hours, mood_rating, exercise_minutes, energy_level)
            VALUES (?, CURDATE(), ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                sleep_hours = VALUES(sleep_hours),
                mood_rating = VALUES(mood_rating),
                exercise_minutes = VALUES(exercise_minutes),
                energy_level = VALUES(energy_level)
        ");
        
        $stmt->execute([
            $userId,
            $_POST['sleep_hours'],
            $_POST['mood_rating'],
            $_POST['exercise_minutes'],
            $_POST['energy_level']
        ]);
        
        $success = 'Wellness data saved successfully!';
    } catch (PDOException $e) {
        $error = 'Failed to save wellness data: ' . $e->getMessage();
    }
}

// Get today's wellness
try {
    $stmt = $pdo->prepare("SELECT * FROM wellness_entries WHERE user_id = ? AND entry_date = CURDATE()");
    $stmt->execute([$userId]);
    $todaysWellness = $stmt->fetch();
} catch (PDOException $e) {
    $todaysWellness = null;
    $error = 'Error fetching today\'s data';
}

// Get recent entries
try {
    $stmt = $pdo->prepare("SELECT * FROM wellness_entries WHERE user_id = ? ORDER BY entry_date DESC LIMIT 14");
    $stmt->execute([$userId]);
    $recentEntries = $stmt->fetchAll();
} catch (PDOException $e) {
    $recentEntries = [];
    $error = 'Error fetching history';
}

// NOW include the templates - NO HTML before this point!
include 'templates/dashboard-header.php';
include 'templates/wellness-content.php';
include 'templates/dashboard-footer.php';
?>