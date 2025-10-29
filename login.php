<?php
session_start();
require_once("settings.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    $query  = "SELECT password FROM user WHERE username='$user'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($pass === $row['password']) {
            $_SESSION['username'] = $user;
            header("Location: profile.php");
            exit;
        } else {
            $error = "Wrong password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post" action="login.php">
  <label>Username: <input type="text" name="username" required></label><br><br>
  <label>Password: <input type="password" name="password" required></label><br><br>
  <button type="submit">Login</button>
</form>
</body>
</html>