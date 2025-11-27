<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: manage-products.php");
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT name, price, brand FROM products WHERE id=$id");
if ($result->num_rows === 0) {
    header("Location: manage-products.php");
    exit();
}
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $brand = $conn->real_escape_string($_POST['brand']);

    $conn->query("UPDATE products SET name='$name', price=$price, brand='$brand' WHERE id=$id");
    header("Location: manage-products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Product</title>
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body>
        <h2>Edit Product</h2>
        <form method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br><br>

            <label>Price:</label><br>
            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br><br>

            <label>Brand:</label><br>
            <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required><br><br>

            <button type="submit">Update Product</button>
        </form>
        <a href="manage-products.php">Back to Manage Products</a>
    </body>
</html>
