<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/css/styles_modern.css">
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>Welcome, <?php echo e($_SESSION['user_name']); ?>!</h1>
    <p>This is protected content for logged-in users.</p>
    <p><a class="btn" href="logout.php">Logout</a> <a href="index.php" class="link">Home</a></p>
  </div>
</div>
</body>
</html>