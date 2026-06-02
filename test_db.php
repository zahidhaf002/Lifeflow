<?php
require_once 'includes/DatabaseConnection_sqlite.php';

// Test query
$stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
$tables = $stmt->fetchAll();

echo "<h2>Tables in database:</h2>";
echo "<ul>";
foreach ($tables as $table) {
    echo "<li>" . $table['name'] . "</li>";
}
echo "</ul>";