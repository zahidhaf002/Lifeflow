<?php
// admin.php
require_once 'includes/session.php';
require_once 'includes/functions.php';

$auth->requireAdmin();

$pageTitle = 'Admin Panel';
$success = '';
$error = '';

// Handle Create User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $fullName = $_POST['new_full_name'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $role = $_POST['new_role'];
    
    // Check if email exists
    $check = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
    $check->execute([$email]);
    
    if ($check->fetch()) {
        $error = "Email already exists";
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $insert = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $insert->execute([$fullName, $email, $hash, $role]);
        $success = "User created successfully";
    }
}

// Handle Update User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $userId = $_POST['edit_user_id'];
    $fullName = $_POST['edit_full_name'];
    $email = $_POST['edit_email'];
    $role = $_POST['edit_role'];
    
    // Don't allow editing own role to prevent lockout
    if ($userId == $_SESSION['user_id']) {
        $error = "Cannot edit your own account here";
    } else {
        if (!empty($_POST['edit_password'])) {
            // Update with new password
            $hash = password_hash($_POST['edit_password'], PASSWORD_BCRYPT);
            $update = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, role = ?, password_hash = ? WHERE user_id = ?");
            $update->execute([$fullName, $email, $role, $hash, $userId]);
        } else {
            // Update without changing password
            $update = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, role = ? WHERE user_id = ?");
            $update->execute([$fullName, $email, $role, $userId]);
        }
        $success = "User updated successfully";
    }
}

// Handle Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];
    
    if ($userId != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $success = "User deleted successfully";
    }
}

// Handle Bulk Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bulk_delete'])) {
    $userIds = explode(',', $_POST['bulk_delete']);
    $count = 0;
    
    foreach ($userIds as $userId) {
        if ($userId != $_SESSION['user_id']) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$userId]);
            $count++;
        }
    }
    
    if ($count > 0) {
        $success = "$count users deleted successfully";
    }
}

// Get all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();

// Get statistics
$totalUsers = count($users);
$adminCount = count(array_filter($users, function($u) { return $u['role'] === 'admin'; }));
$studentCount = $totalUsers - $adminCount;

$stmt = $pdo->query("SELECT COUNT(*) as count FROM tasks");
$totalTasks = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM wellness_entries");
$totalWellness = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM correlation_insights");
$totalInsights = $stmt->fetch()['count'];

include 'templates/dashboard-header.php';
include 'templates/admin-content.php';
include 'templates/dashboard-footer.php';
?>