<?php
include '../include/db_connect.php';

$limit = 6;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$sort = $_GET['sort'] ?? 'default';
$search = $_GET['search'] ?? '';
$brand = $_GET['brand'] ?? '';

// ORDER BY logic
switch ($sort) {
    case 'name_asc':  $order = "ORDER BY name ASC"; break;
    case 'name_desc': $order = "ORDER BY name DESC"; break;
    case 'price_asc': $order = "ORDER BY price ASC"; break;
    case 'price_desc': $order = "ORDER BY price DESC"; break;
    default:          $order = "";
}

// Build WHERE conditions dynamically
$conditions = [];
$params = [];
$types = "";

// Search filter
if (!empty($search)) {
    $conditions[] = "name LIKE ?";
    $params[] = "$search%";
    $types .= "s";
}

// Brand filter
if (!empty($brand)) {
    $conditions[] = "brand = ?";
    $params[] = $brand;
    $types .= "s";
}

// Build WHERE clause
$where = "";
if (count($conditions) > 0) {
    $where = "WHERE " . implode(" AND ", $conditions);
}

// Final SQL
$sql = "SELECT * FROM products $where $order LIMIT ? OFFSET ?";

// Bind limit + offset
$params[] = $limit;
$params[] = $offset;
$types .= "ii";

$stmt = $conn->prepare($sql);

// Bind dynamic parameters
$stmt->bind_param($types, ...$params);

$stmt->execute();
$result = $stmt->get_result();

// Render product cards
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stock = (int)$row['stock'];

        if ($stock > 0) {
            $stockHTML = "<button class='add-to-cart' product-id='{$row['id']}' data-stock='{$stock}'>Add to Cart</button>";
        } else {
            $stockHTML = "<span class='out-of-stock'>Out of Stock</span>";
        }

        echo "
            <a href='product-detail.php?id={$row['id']}' class='product-link'>
                <div class='card'>
                    <img src='{$row['image']}' alt='{$row['name']}' style='width:100%'>
                    <h1>{$row['name']}</h1>
                    <p class='price'>\${$row['price']}</p>
                    <p>{$row['description']}</p>
                    <p>$stockHTML</p>
                </div>
            </a>
        ";
    }
}
?>
