<?php
session_start();
include '../include/db_connect.php';

// mock social login
$provider = $_GET['provider'] ?? 'google';

if ($provider === 'google') {
    $googleEmail = "test_google@example.com";
    $googleName  = "Google User";
} elseif ($provider === 'facebook') {
    $googleEmail = "test_facebook@example.com";
    $googleName  = "Facebook User";
} else {
    $googleEmail = "test_twitter@example.com";
    $googleName  = "Twitter User";
}

// check if user exist
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $googleEmail);

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// if not -> create new user
if (!$user) {
    $insert = $conn->prepare("
        INSERT INTO users (username, email)
        VALUES (?, ?)
    ");
    $insert->bind_param("ss", $googleName, $googleEmail);
    $insert->execute();

    // fetch newly created user
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $googleEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

$_SESSION['user_id']   = $user['user_id'];
$_SESSION['username']  = $user['username'];
$_SESSION['email']     = $user['email'];
$_SESSION['role']      = $user['role'] ?? 'user';
$_SESSION['login_type'] = $provider;

// redirect
header("Location: ../dashboard.php");
exit;
?>
