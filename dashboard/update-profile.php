<?php
session_start();
include '..include/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized";
    exit();
}

$user_id = $_SESSION['user_id'];

$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];

// Check duplicate email
$chk = $conn->prepare("SELECT id FROM users WHERE email=? AND id!=?");
$chk->bind_param("si", $email, $user_id);
$chk->execute();
$chk->store_result();

if ($chk->num_rows > 0) {
    echo "Email is already used.";
    exit();
}
$chk->close();

// Update profile (no password)
if ($password == "") {
    $stmt = $conn->prepare(
        "UPDATE users SET email=?, phone=?, address=? WHERE id=?"
    );
    $stmt->bind_param("sssi", $email, $phone, $address, $user_id);
    $stmt->execute();
    echo "success";
    exit();
}

// Update with password
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE users SET email=?, phone=?, address=?, password=? WHERE id=?"
);
$stmt->bind_param("ssssi", $email, $phone, $address, $hashed, $user_id);
$stmt->execute();

echo "success";
?>