<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Login — Dream House</title>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="icon" href="../favicon.svg" type="image/svg+xml">
<style>
  .login-wrap{ min-height:100vh; display:flex; align-items:center; justify-content:center; background: linear-gradient(180deg, rgba(18,32,58,0.85), rgba(18,32,58,0.95)), url('../assets/img/hero-villa.jpg') center/cover no-repeat; padding:24px; }
  .login-card{ background:var(--cream); width:100%; max-width:420px; padding:44px 38px; border:1px solid var(--cream-line); box-shadow:0 30px 60px rgba(0,0,0,0.35); }
  .login-card .brand{ justify-content:center; margin-bottom:6px; }
  .login-card .sub-line{ text-align:center; color:#6B6455; font-size:0.85rem; margin-bottom:30px; }
  .login-card label{ margin-top:16px; }
  .login-card .btn{ width:100%; justify-content:center; margin-top:26px; }
  .back-link{ display:block; text-align:center; margin-top:20px; font-size:0.82rem; color:#6B6455; }
  .error-box{ background:#F6E4E0; border:1px solid #E3A79A; color:#8A2E1E; padding:12px 16px; font-size:0.85rem; margin-top:20px; }
</style>
</head>
<body>
<div class="login-wrap">
  <div class="login-card">
    <div class="brand" style="justify-content:center;">Dream House<span class="dot">.</span></div>
    <div class="sub-line">Staff &amp; Broker Portal</div>

    <?php if (isset($_GET['error'])): ?>
      <div class="error-box">
        Invalid username or password.
        <?php if (isset($_GET['dberror'])): ?>
          <br><small><?php echo htmlspecialchars($_GET['dberror']); ?></small>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <form action="check_login.php" method="POST" autocomplete="off">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="e.g. admin" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required>

      <button type="submit" class="btn btn-dark">Sign In</button>
    </form>

    <a class="back-link" href="../index.html">&larr; Back to Dream House</a>
  </div>
</div>
</body>
</html>
