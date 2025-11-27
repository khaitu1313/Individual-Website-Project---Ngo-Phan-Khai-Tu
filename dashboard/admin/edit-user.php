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

// Fetch user info
$result = $conn->query("SELECT username, email, role FROM users WHERE id=$id");
if ($result->num_rows === 0) {
    header("Location: manage-users.php");
    exit();
}
$user = $result->fetch_assoc();

// Update user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);

    $conn->query("UPDATE users SET username='$username', email='$email', role='$role' WHERE id=$id");
    header("Location: manage-users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <h2>Edit User</h2>
        <form method="POST">
            <label>Username:</label><br>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

            <label>Role:</label><br>
            <select name="role">
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            </select><br><br>

            <button type="submit">Update</button>
        </form>
        <a href="manage-users.php">Back to Manage Users</a>
    </body>
</html>
