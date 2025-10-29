<?php
session_start();
require_once("settings.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT username, email FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Profile</title></head>
<body>
<h1>Welcome, <?= htmlspecialchars($user['username']) ?></h1>
<p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

<hr>
<h2>Edit Profile</h2>
<form method="post" action="update_profile.php">
  <label>New Email:
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
  </label>
  <button type="submit">Save</button>
</form>

<p><a href="logout.php">Logout</a></p>
</body>
</html>