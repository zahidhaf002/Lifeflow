<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$pageTitle = 'Register';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match';
    } else {
        $result = $auth->register($fullName, $email, $password);
        if ($result['success']) {
            $success = 'Registration successful! Please login.';
        } else {
            $error = $result['message'];
        }
    }
}

include 'templates/header.php';
include 'templates/register-form.php';
include 'templates/footer.php';
?>