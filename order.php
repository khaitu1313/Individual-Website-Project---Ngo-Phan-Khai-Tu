<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your Orders</title>

        <link rel="stylesheet" href="css/order.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
    </head>

    <body>
        <?php include 'include/navbar.php'; ?>

        <main class="order-container">
            <h2>Your Orders</h2>

            <div id="orderBody">
                <p class="loading">Loading...</p>
            </div>
        </main>


        <?php include 'include/footer.php'; ?>

        <script src="javascript/order.js"></script>
    </body>
</html>
