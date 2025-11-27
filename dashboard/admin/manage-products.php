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
        <title>Manage Products</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>

        <h2>Manage Products</h2>
        <a href="add-product.php" class="btn">Add New Product</a>

        <?php
        $result = $conn->query("SELECT id, name, price, brand FROM products");

        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Brand</th><th>Actions</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>\${$row['price']}</td>
                    <td>{$row['brand']}</td>
                    <td>
                        <a href='add-product.php?id={$row['id']}'>Add</a> |
                        <a href='edit-product.php?id={$row['id']}'>Edit</a> |
                        <a href='delete-product.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>
            ";
        }
        echo "</table>";
        ?>

    </body>
</html>
