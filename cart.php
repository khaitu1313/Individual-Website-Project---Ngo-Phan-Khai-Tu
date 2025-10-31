<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>
        <?php session_start(); ?>

        <main class="cart-page">
            <div class="cart-container">
                <h1 class="cart-title">Your Shopping Cart</h1>

                <?php
                    $total = 0;

                    if(!empty($_SESSION['cart'])):
                        foreach($_SESSION['cart'] as $i => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                ?>
                        <div class="cart-item">
                            <!-- Function htmlspecialchars() protects items'names from Cross-Site Scripting (XSS) attacks. -->
                            <img src="<?= htmlspecialchars($item['name']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            <div class="cart-detail">
                                <h3><?= htmlspecialchars($item['name']) ?></h3>
                                <p>Price: $<?= number_format($item['price'], 2) ?></p>
                                <!-- Quantity controller -->
                                <div class="quantity-control" data-index="<?= $i ?>">
                                    <button class="qty-btn decrease">−</button>
                                    <input type="number" value="<?= $item['quantity'] ?>" min="1" readonly>
                                    <button class="qty-btn increase">+</button>
                                </div>
                                <p><strong>Subtotal: $<?= number_format($subtotal, 2) ?></strong></p>

                                <!-- Remove from cart -->
                                <form action="remove-from-cart.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="index" value="<?php echo $i; ?>">
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </div>
                        </div>
                <?php endforeach; ?>
                    <div class="cart-summary">
                        <h2>Total: $<?= number_format($total, 2) ?></h2>
                        <button class="checkout-btn">Checkout</button>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Link to javascript -->
        <script src="javascript/cart.js"></script>
    </body>
</html>