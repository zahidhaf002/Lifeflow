<?php
require_once 'includes/session.php';

if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$pageTitle = 'Login';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $result = $auth->login($email, $password);
    if ($result['success']) {
        header('Location: ' . ($result['role'] === 'admin' ? 'admin.php' : 'dashboard.php'));
        exit();
    } else {
        $error = $result['message'];
    }
}

include 'templates/header.php';
include 'templates/login-form.php';
include 'templates/footer.php';
?>