<?php
session_start();
include '../include/db_connect.php';

// 1. User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// 2. Cart must exist
if (!isset($_SESSION['checkout_cart']) || empty($_SESSION['checkout_cart'])) {
    header("Location: ../cart.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$cart    = $_SESSION['checkout_cart'];

$total = 0;

// 3. Prepare insert statement
$stmt = $conn->prepare("
    INSERT INTO orders (user_id, product_id, amount, product_image, order_date)
    VALUES (?, ?, ?, ?, NOW())
");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$product_id    = 0;
$item_total    = 0.0;
$product_image = "";

$stmt->bind_param("iids", $user_id, $product_id, $item_total, $product_image);

// 4. Loop through cart items
foreach ($cart as $item) {

    $product_id    = $item['id'];
    $quantity      = $item['quantity'];
    $price         = $item['price'];
    $product_image = $item['image'];

    $item_total = $price * $quantity;
    $total += $item_total;

    if (!$stmt->execute()) {
        die("Insert failed: " . $stmt->error);
    }

    // Reduce stock
    $update = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    if (!$update) {
        die("Update prepare failed: " . $conn->error);
    }

    $update->bind_param("ii", $quantity, $product_id);

    if (!$update->execute()) {
        die("Stock update failed: " . $update->error);
    }

    $update->close();
}

$stmt->close();

// 5. Clear checkout session
unset($_SESSION['checkout_cart']);
unset($_SESSION['checkout_total']);

// 6. Redirect to success
header("Location: ../index.php?success=1&total=" . number_format($total, 2));
exit;
?>