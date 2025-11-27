<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: view-order.php");
    exit();
}

$order_id = intval($_GET['id']);

// Fetch order info
$orderResult = $conn->query("
    SELECT orders.id, users.username, users.email, orders.total, orders.created_at
    FROM orders
    JOIN users ON orders.user_id = users.id
    WHERE orders.id = $order_id
");

if ($orderResult->num_rows === 0) {
    echo "Order not found!";
    exit();
}

$order = $orderResult->fetch_assoc();

// Fetch order items
$itemsResult = $conn->query("
    SELECT products.name, products.brand, order_items.quantity, order_items.price
    FROM order_items
    JOIN products ON order_items.product_id = products.id
    WHERE order_items.order_id = $order_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Order #<?= $order['id'] ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> <?= $order['id'] ?></p>
    <p><strong>User:</strong> <?= htmlspecialchars($order['username']) ?> (<?= htmlspecialchars($order['email']) ?>)</p>
    <p><strong>Total:</strong> $<?= $order['total'] ?></p>
    <p><strong>Date:</strong> <?= $order['created_at'] ?></p>

    <h3>Items</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Product</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        <?php while ($item = $itemsResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['brand']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= $item['price'] ?></td>
                <td>$<?= $item['quantity'] * $item['price'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="view-order.php">Back to Orders</a>
</body>
</html>
