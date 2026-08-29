<?php
/**
 * config.php
 * Bootstraps a tiny SQLite database for the "Staff Login" demo.
 * This exists ONLY so the SQL Injection assignment has a real database
 * to query against — it is intentionally minimal.
 */

$dbFile = __DIR__ . '/database.sqlite';
$isNew  = !file_exists($dbFile);

$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($isNew) {
    $pdo->exec("
        CREATE TABLE users (
            id       INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            password TEXT NOT NULL,
            is_admin INTEGER NOT NULL DEFAULT 0,
            full_name TEXT
        )
    ");

    $seed = $pdo->prepare("INSERT INTO users (username, password, is_admin, full_name) VALUES (?, ?, ?, ?)");
    $seed->execute(['admin',   'DreamHouse@2026', 1, 'Site Administrator']);
    $seed->execute(['daniyal', 'khayaban123',     0, 'Muhammad Daniyal']);
    $seed->execute(['kaneez',  'clifton456',      0, 'Kaneez Fatima']);
}
