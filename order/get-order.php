<?php
session_start();
include '../include/db_connect.php';

// Only logged-in users
if (!isset($_SESSION['user_id'])) {
    echo "<p class='no-orders'>Not logged in.</p>";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT 
            o.order_id,
            p.name AS product_name,
            o.amount,
            o.product_image,
            o.order_date
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = ?
        ORDER BY o.order_date DESC";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL PREPARE ERROR: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// No results
if ($result->num_rows === 0) {
    echo "<p class='no-orders'>No orders found.</p>";
    exit();
}

// Show in cart-style design
while ($row = $result->fetch_assoc()) {

    $img   = htmlspecialchars($row['product_image']);
    $name  = htmlspecialchars($row['product_name']);
    $value = number_format($row['amount'], 0, ',', '.');
    $date  = $row['order_date'];

    echo "
    <div class='order-item'>
        <img src='$img' alt='Product'>
        
        <div class='order-details'>
            <h3>$name</h3>
            <p><strong>$ {$value}</strong></p>
            <p class='order-date'>Ordered on: $date</p>
            <p>Order ID: {$row['order_id']}</p>
        </div>
    </div>
    ";
}
?>
