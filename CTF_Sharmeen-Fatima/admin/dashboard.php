<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
$user = $_SESSION['user'];
$isAdmin = !empty($user['is_admin']) && $user['is_admin'] == 1;

require 'config.php';
$allUsers = $pdo->query("SELECT id, username, password, is_admin, full_name FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Dashboard — Dream House</title>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="icon" href="../favicon.svg" type="image/svg+xml">
<style>
  .dash-wrap{ max-width:900px; margin:0 auto; padding:70px 24px; }
  .dash-card{ background:var(--white); border:1px solid var(--cream-line); padding:36px; margin-bottom:26px; }
  table{ width:100%; border-collapse:collapse; font-size:0.9rem; }
  th, td{ text-align:left; padding:10px 12px; border-bottom:1px solid var(--cream-line); }
  th{ color:var(--brass-dark); text-transform:uppercase; font-size:0.72rem; letter-spacing:0.08em; }
</style>
</head>
<body style="background:var(--cream);">
<div class="dash-wrap">
  <div class="eyebrow">Staff Portal</div>
  <h1>Welcome, <?php echo htmlspecialchars($user['username'] ?? 'unknown'); ?></h1>

  <?php if ($isAdmin): ?>
    <div class="dash-card">
      <div class="eyebrow">Access Level</div>
      <h3 style="margin-bottom:14px;">Administrator session confirmed</h3>
      <p style="color:#5C5648; margin-bottom:20px;">If you reached this page using a crafted username/password (an injection payload) rather than the real admin password, you've successfully exploited the SQL Injection vulnerability in <code>check_login.php</code>.</p>
      <div class="plaque" style="display:inline-flex;">
        <span class="plaque-eyebrow">SQL Injection Flag</span>
        <span class="plaque-title">PicoCTF{sql1_4uth_byp4ss_1s_r34l}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="eyebrow">users table (dumped)</div>
      <h3 style="margin-bottom:16px;">Full contents of the <code>users</code> table</h3>
      <table>
        <tr><th>ID</th><th>Username</th><th>Password</th><th>Admin?</th><th>Full Name</th></tr>
        <?php foreach ($allUsers as $u): ?>
        <tr>
          <td><?php echo htmlspecialchars($u['id']); ?></td>
          <td><?php echo htmlspecialchars($u['username']); ?></td>
          <td><?php echo htmlspecialchars($u['password']); ?></td>
          <td><?php echo $u['is_admin'] ? 'Yes' : 'No'; ?></td>
          <td><?php echo htmlspecialchars($u['full_name']); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <p style="color:#5C5648; margin-top:16px; font-size:0.85rem;">In a real breach, this is exactly the kind of table an attacker extracts with a UNION-based injection — usernames, passwords, and roles, all in one request.</p>
    </div>
  <?php else: ?>
    <div class="dash-card">
      <p style="color:#5C5648;">You're logged in as a regular staff account. Only the <code>admin</code> account is flagged as administrator — try crafting a payload that logs you in <em>as admin</em> without knowing the real password.</p>
    </div>
  <?php endif; ?>

  <a href="logout.php" class="btn btn-dark">Log Out</a>
</div>
</body>
</html>
