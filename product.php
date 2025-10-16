<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>

        <!-- <main>
            <div class="product-container">
                <div class="card">
                    <img src="images/products/sneaker_AG.jpg" alt="Sneakers" style="width:100%">
                    <h1>AG1014</h1>
                    <p class="price">$19.99</p>
                    <p>Some text about the sneakers...</p>
                    <p><button>Add to Cart</button></p>
                </div>

                <div class="card">
                    <img src="images/products/Air-Jordan-4-Retro.jpg" alt="Sneakers" style="width:100%">
                    <h1>Air Jordan 4 Retro</h1>
                    <p class="price">$99.99</p>
                    <p>Some text about the sneakers...</p>
                    <p><button>Add to Cart</button></p>
                </div>
            </div>
        </main> -->

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
                                    <p><button>Add to Cart</button></p>
                                </div>
                            ";
                        }
                    }
                ?>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

    </body>
</html>