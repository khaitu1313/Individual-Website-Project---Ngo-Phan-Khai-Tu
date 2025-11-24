<?php
session_start();
include '../include/db_connect.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=empty_fields");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Correct password (column name FIXED)
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'] ?? '';
    $_SESSION['role'] = $user['role'];

    header("Location: ../dashboard.php");
    exit;
}

// Login failed
header("Location: ../login.php?error=invalid_credentials");
exit;
?>
