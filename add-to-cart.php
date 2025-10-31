<?php
session_start();
include 'include/db_connect.php';

    if (isset($_POST['id'])) {
        $productId = $_POST['id'];

        $sql = "SELECT* FROM products WHERE id =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

        $found = FALSE;
        foreach ($_SESSION['cart'] as &$item) {
            if($item['id'] == $productId) {
                $item['quantity']++;
                $found = TRUE;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'image' => $row['image'],
                'quantity' => 1
            ];
        }

            echo "Added {$row['name']} to cart!";
        }
        else {
            echo "Product not found!";
        }
    }
    else {
        echo "Invalid request";
    }
?>