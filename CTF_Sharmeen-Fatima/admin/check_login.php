<?php
/**
 * check_login.php
 * ------------------------------------------------------------------
 * ASSIGNMENT: SQL Injection CTF
 * This handler is INTENTIONALLY VULNERABLE for teaching purposes.
 *
 * The bug: user input is concatenated directly into the SQL string
 * instead of using a parameterized query / prepared statement with
 * bound parameters. That means anything the user types as
 * "username" or "password" becomes part of the SQL the database
 * executes — including quotes, OR clauses, UNION SELECTs, comments...
 *
 * DO NOT copy this pattern into a real project. The fix is shown
 * at the bottom of this file (commented out) using a proper
 * prepared statement with bound parameters.
 * ------------------------------------------------------------------
 */

session_start();
require 'config.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// --- VULNERABLE QUERY (raw string concatenation, no sanitization) ---
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$result = null;
$dberror = null;

try {
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Leaking the raw DB error is ALSO a classic vulnerability
    // (verbose error messages help attackers fine-tune payloads).
    $dberror = $e->getMessage();
}

if ($result) {
    $_SESSION['user'] = $result;
    header('Location: dashboard.php');
    exit;
} else {
    $redirect = 'login.php?error=1';
    if ($dberror) {
        $redirect .= '&dberror=' . urlencode($dberror);
    }
    header('Location: ' . $redirect);
    exit;
}

/*
 * ---------------- THE FIX (for the write-up / report) ----------------
 * $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u AND password = :p");
 * $stmt->execute(['u' => $username, 'p' => $password]);
 * $result = $stmt->fetch(PDO::FETCH_ASSOC);
 *
 * Bound parameters are sent to SQLite separately from the query text,
 * so user input can never change the *structure* of the SQL statement —
 * it is only ever treated as data, never as code.
 * ----------------------------------------------------------------------
 */
