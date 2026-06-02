<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

$pageTitle = 'Profile';
$userId = $_SESSION['user_id'];
$success = '';
$passwordSuccess = '';
$passwordError = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ? WHERE user_id = ?");
        $stmt->execute([$_POST['full_name'], $_POST['email'], $userId]);
        $_SESSION['full_name'] = $_POST['full_name'];
        $_SESSION['email'] = $_POST['email'];
        $success = "Profile updated successfully";
    } elseif (isset($_POST['change_password'])) {
        // Verify current password
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        if (password_verify($_POST['current_password'], $user['password_hash'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $newHash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
                $stmt->execute([$newHash, $userId]);
                $passwordSuccess = "Password changed successfully";
            } else {
                $passwordError = "New passwords do not match";
            }
        } else {
            $passwordError = "Current password is incorrect";
        }
    }
}

// Get user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

include 'templates/dashboard-header.php';
include 'templates/profile-content.php';
include 'templates/dashboard-footer.php';
?>