<?php require 'config.php'; ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login System</title>
  <link rel="stylesheet" href="assets/css/styles_modern.css">
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>Login System</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
      <p>Welcome <?php echo e($_SESSION['user_name']); ?> — <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
      <p><a class="btn" href="register.php">Register</a> <a class="btn" href="login.php">Login</a></p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>