<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $brand = $conn->real_escape_string($_POST['brand']);

    $conn->query("INSERT INTO products (name, price, brand) VALUES ('$name', $price, '$brand')");
    header("Location: manage-products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Product</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <h2>Add New Product</h2>
        <form method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" required><br><br>

            <label>Brand:</label><br>
            <input type="text" name="brand" required><br><br>

            <button type="submit">Add Product</button>
        </form>
        <a href="manage-products.php">Back to Manage Products</a>
    </body>
</html>
