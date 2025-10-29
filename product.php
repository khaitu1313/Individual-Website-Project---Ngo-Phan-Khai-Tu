<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>

        <main>
            <div class="product-container">
                <?php
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

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
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="javascript/product.js"></script>

    </body>
</html>