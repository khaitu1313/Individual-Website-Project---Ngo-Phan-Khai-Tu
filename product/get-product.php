<?php
    include '../include/db_connect.php';

    $limit = 6; // Max products load
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0; // Number of items already loaded (if not provided then = 0)
    $sort = $_GET['sort'] ?? 'default'; // If exist sort parameter, use it, otherwise use default
    $search = $_GET['search'] ?? '';

    // Sorting using SQL 'ORDER BY'
    switch($sort) {
        case 'name_asc': $order = "ORDER BY name ASC"; break;
        case 'name_desc': $order =  "ORDER BY name DESC"; break;
        case 'price_asc': $order = "ORDER BY price ASC"; break;
        case 'price_desc': $order = "ORDER BY price DESC"; break;
        default: $order = "";
    }

    //Search products
    if(!(empty($search))) {
        $sql = "SELECT * FROM products WHERE name LIKE ? $order LIMIT ? OFFSET ?"; // '?' are parameters which are bound later
        $stmt = $conn->prepare($sql);   // secure sql from sql injection 
        $searchTerm = "%$search%";      // users'searching term
        $stmt->bind_param("sii", $searchTerm, $limit, $offset); // bind searchTerm(string), limit and offset(both integer)
    }
    else {
        $sql = "SELECT * FROM products $order LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    //Product cards show case
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $stock = (int)$row['stock'];
            if ($stock > 0) {
                $stockHTML = "<button class='add-to-cart' product-id='{$row['id']}' data-stock='{$stock}'>Add to Cart</button>";
            } else {
                $stockHTML = "<span class='out-of-stock'>Out of Stock</span>";
            }

            echo "
                <div class='card'>
                    <img src='{$row['image']}' alt='{$row['name']}' style='width:100%'>
                    <h1>{$row['name']}</h1>
                    <p class='price'>\${$row['price']}</p>
                    <p>{$row['description']}</p>
                    <p>$stockHTML</p>
                </div>
                ";           
        }             
    }
?>