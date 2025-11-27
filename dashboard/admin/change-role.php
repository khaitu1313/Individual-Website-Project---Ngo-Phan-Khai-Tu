<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: manage-users.php");
    exit();
}

$id = intval($_GET['id']);

// Get current role
$result = $conn->query("SELECT role FROM users WHERE id=$id");
if ($result->num_rows === 0) {
    header("Location: manage-users.php");
    exit();
}
$user = $result->fetch_assoc();
$newRole = $user['role'] === 'admin' ? 'customer' : 'admin';

$conn->query("UPDATE users SET role='$newRole' WHERE id=$id");

header("Location: manage-users.php");
exit();
?>
