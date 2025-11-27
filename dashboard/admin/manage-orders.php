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
        <title>Manage Orders</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>

        <h2>Manage Orders</h2>

        <?php
        $result = $conn->query("
            SELECT orders.id, users.username, orders.total, orders.created_at 
            FROM orders 
            JOIN users ON orders.user_id = users.id
        ");

        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Order ID</th><th>User</th><th>Total</th><th>Date</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>\${$row['total']}</td>
                    <td>{$row['created_at']}</td>
                    <td><a href='view-order.php?id={$row['id']}'>View</a></td>
                </tr>
            ";
        }
        echo "</table>";
        ?>

    </body>
</html>
