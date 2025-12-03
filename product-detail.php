<?php
include 'include/db_connect.php';
session_start();

if (!isset($_GET['id'])) {
    die("Product not found.");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) die("Product not found.");

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= $product['name'] ?></title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/product-detail.css">
    </head>
    <body>

    <?php include 'include/navbar.php'; ?>

    <div class="product-detail-container">
        
        <img src="<?= $product['image'] ?>" class="product-img">

        <div class="product-info">
            <h1><?= $product['name'] ?></h1>
            <p class="price">$<?= $product['price'] ?></p>
            <p><?= $product['description'] ?></p>

            <!-- Quantity selector -->
            <div class="quantity-box">
                <button id="minus">-</button>
                <input type="text" id="quantity" value="1" readonly>
                <button id="plus">+</button>
            </div>

            <!-- Add to cart -->
            <button id="add-cart" data-id="<?= $product['id'] ?>" data-stock="<?= $product['stock'] ?>">
                Add to Cart
            </button>
        </div>

    </div>

    <script src="javascript/product-detail.js"></script>

    </body>
</html>
