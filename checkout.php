<?php
    session_start();
    include 'include/db_connect.php';

    // User must login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Prevent direct access to checkout
    if (!isset($_SESSION['checkout_total']) || !isset($_SESSION['checkout_cart'])) {
        header("Location: cart.php");
        exit();
    }

    $total = $_SESSION['checkout_total'];      // Total amount
    $cartItems = $_SESSION['checkout_cart'];  // Array of cart items
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/checkout.css">
    </head>
    <body>

        <?php include 'include/navbar.php'; ?>
        <main>
            <div class="checkout-container">
                <h2>Checkout</h2>
                <!-- $total -->
                <p>Total: <strong>$<?php echo $total; ?></strong></p>

                <!-- Demo QR -->
                <img src="images/checkout/qr_code.png" class="qr" alt="QR Code">

                <button class="pay-btn" id="payBtn">Make Payment</button>
            </div>

            <!-- POPUP -->
            <div class="popup" id="successPopup">
                <div class="popup-box">
                    <img src="images/checkout/green-tick.png">
                    <h3>Successful Payment!</h3>
                    <p>Thank you so much ❤️</p>
                </div>
            </div>
        </main>
        <?php include 'include/footer.php'; ?>

        <script src="javascript/checkout.js"></script>

    </body>
</html>
