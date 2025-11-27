<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>

    <body>

        <h2>Manage Users</h2>

        <?php
        $result = $conn->query("SELECT id, username, email, role FROM users");

        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['role']}</td>
                    <td>
                        <a href='edit-user.php?id={$row['id']}'>Edit</a> |
                        <a href='delete-user.php?id={$row['id']}'>Delete</a> |
                        <a href='change-role.php?id={$row['id']}'>Change Role</a>
                    </td>
                </tr>
            ";
        }
        echo "</table>";
        ?>

    </body>
</html>