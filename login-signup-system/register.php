<?php
require 'config.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass2 = $_POST['password_confirm'] ?? '';

    if (!$name || !$email || !$pass || !$pass2) {
        $errors[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email.';
    } elseif ($pass !== $pass2) {
        $errors[] = 'Passwords do not match.';
    } elseif (strlen($pass) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    } else {
        $stmt = $mysqli->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Email already registered.';
            $stmt->close();
        } else {
            $stmt->close();
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $ins = $mysqli->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
            $ins->bind_param('sss', $name, $email, $hash);
            if ($ins->execute()) {
                $_SESSION['user_id'] = $ins->insert_id;
                $_SESSION['user_name'] = $name;
                header('Location: dashboard.php');
                exit;
            } else {
                $errors[] = 'Registration failed: ' . $mysqli->error;
            }
            $ins->close();
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/styles_modern.css">
</head>
<body>
<div class="wrap">
  <div class="card">
    <h2>Create account</h2>
    <?php if ($errors): ?>
      <div class="errors">
        <?php foreach ($errors as $err): ?><div class="err"><?php echo e($err); ?></div><?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" novalidate>
      <label>Name<input type="text" name="name" value="<?php echo e($_POST['name'] ?? '') ?>" required></label>
      <label>Email<input type="email" name="email" value="<?php echo e($_POST['email'] ?? '') ?>" required></label>
      <label>Password<input type="password" name="password" required></label>
      <label>Confirm Password<input type="password" name="password_confirm" required></label>
      <button class="btn" type="submit">Register</button>
    </form>
    <p class="small">Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>
</body>
</html>