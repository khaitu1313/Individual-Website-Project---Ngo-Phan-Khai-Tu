<?php
session_start();
include '../include/db_connect.php';

// 1. Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?redirect=checkout");
    exit();
}

// 2. Must have a cart
if (empty($_SESSION['cart'])) {
    header("Location: ../cart.php?error=empty_cart");
    exit();
}

// 3. Validate posted total
if (!isset($_POST['total']) || !is_numeric($_POST['total'])) {
    header("Location: ../cart.php?error=invalid_total");
    exit();
}

// 4. Save checkout info
$_SESSION['checkout_total'] = floatval($_POST['total']);
$_SESSION['checkout_cart'] = $_SESSION['cart'];

// 5. Redirect to checkout page
header("Location: ../checkout.php");
exit();
