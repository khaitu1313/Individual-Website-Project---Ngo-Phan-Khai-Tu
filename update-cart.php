<?php
    session_start();

    $response = ["success" => false];

    if (isset($_POST['index']) && isset($_POST['action'])) {
        $index = intval($_POST['index']);
        $action = $_POST['action'];

        if (isset($_SESSION['cart'][$index])) {
            if ($action === "increase") {
                $_SESSION['cart'][$index]['quantity']++;
            } elseif ($action === "decrease") {
                $_SESSION['cart'][$index]['quantity']--;
                if ($_SESSION['cart'][$index]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    $response["removed"] = true;
                }
            }

            // Recalculate total
            $newTotal = 0;
            foreach ($_SESSION['cart'] as $item) {
                $newTotal += $item['price'] * $item['quantity'];
            }

            $response["success"] = true;
            $response["newQuantity"] = $_SESSION['cart'][$index]['quantity'] ?? 0;
            $response["newTotal"] = $newTotal;
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
?>
