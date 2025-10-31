<?php
    include '../include/db_connect.php';

    $limit = 6; // Max products load
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // Number of items already loaded (if not provided then = 0)
    $sort = $_GET['sort'] ?? 'default'; // If exist sort parameter, use it, otherwise use default

    // Sorting with SQL 'ORDER BY'
    switch($sort) {
        case 'name_asc': $order = "ORDER BY name ASC"; break;
        case 'name_desc': $order =  "ORDER BY name DESC"; break;
        case 'price_asc': $order = "ORDER BY price ASC"; break;
        case 'price_desc': $order = "ORDER BY price DESC"; break;
        default: $order = "";
    }

    $sql = "SELECT * FROM products $order LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);   // Prevent SQL injection
    $stmt->bind_param("ii", $limit, $offset); // Bind limit and offset to integer
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "
                <div class='card'>
                    <img src='{$row['image']}' alt='{$row['name']}' style='width:100%'>
                    <h1>{$row['name']}</h1>
                    <p class='price'>\${$row['price']}</p>
                    <p>{$row['description']}</p>
                    <p><button class='add-to-cart' product-id='{$row['id']}'>Add to Cart</button></p>
                </div>
                ";           
        }             
    }
?>