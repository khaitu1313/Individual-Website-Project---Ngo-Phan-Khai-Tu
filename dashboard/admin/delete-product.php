<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit();
}
include '../../include/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM products WHERE id=$id");
}

header("Location: manage-products.php");
exit();
?>
