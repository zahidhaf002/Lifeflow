<?php
try {
    $dbPath = __DIR__ . '/../data/data.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Enable foreign key support in SQLite
    $pdo->exec("PRAGMA foreign_keys = ON");
    
    // Optional: Enable write-ahead logging for better performance
    $pdo->exec("PRAGMA journal_mode = WAL");
} catch (PDOException $e) {
    error_log('SQLite Connection failed: ' . $e->getMessage());
    die('Database connection error. Please try again later.');
}
?>