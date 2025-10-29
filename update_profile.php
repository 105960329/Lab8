<?php
session_start();
require_once("settings.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = trim($_POST['email']);
    $username = $_SESSION['username'];

    if ($newEmail !== '') {
        $query = "UPDATE user SET email='$newEmail' WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Email updated successfully');window.location='profile.php';</script>";
        } else {
            echo "<script>alert('Update failed');window.location='profile.php';</script>";
        }
    }
} else {
    header("Location: profile.php");
    exit;
}
?>