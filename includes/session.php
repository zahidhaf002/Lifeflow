<?php
session_start();
require_once 'Auth.php';
require_once 'DatabaseConnection.php';
require_once 'functions.php';

$auth = new Auth($pdo);

// Check if user is logged in for protected pages
$public_pages = ['index.php', 'login.php', 'register.php'];
$current_page = basename($_SERVER['PHP_SELF']);

if (!in_array($current_page, $public_pages) && !$auth->isLoggedIn()) {
    header('Location: login.php');
    exit();
}
?>