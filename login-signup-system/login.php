<?php
require 'config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (!$email || !$pass) {
        $errors[] = 'Email and password are required.';
    } else {
        $stmt = $mysqli->prepare('SELECT id,name,password FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id,$name,$hash);
            $stmt->fetch();
            if (password_verify($pass, $hash)) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = 'Invalid credentials.';
            }
        } else {
            $errors[] = 'Invalid credentials.';
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/styles_modern.css">
</head>
<body>
<div class="wrap">
  <div class="card">
    <h2>Login</h2>
    <?php if ($errors): ?>
      <div class="errors"><?php foreach ($errors as $err): ?><div class="err"><?php echo e($err); ?></div><?php endforeach; ?></div>
    <?php endif; ?>
    <form method="post" novalidate>
      <label>Email<input type="email" name="email" value="<?php echo e($_POST['email'] ?? '') ?>" required></label>
      <label>Password<input type="password" name="password" required></label>
      <button class="btn" type="submit">Login</button>
    </form>
    <p class="small">Don't have an account? <a href="register.php">Register</a></p>
  </div>
</div>
</body>
</html>