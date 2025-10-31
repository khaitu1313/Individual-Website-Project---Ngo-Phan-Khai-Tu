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
            <!-- Sorting dropdown -->
            <div class="sorting-container">
                <label for="sort">Sort by:</label>
                <select name="sort" id="sort">
                    <option value="default">Default</option>
                    <option value="name_asc">Name(A-Z)</option>
                    <option value="name_desc">Name(Z-A)</option>
                    <option value="price_asc">Price(Low-High)</option>
                    <option value="price_desc">Price(High-Low)</option>
                </select>
            </div>
            
            <!-- Products showcase + AJAX scroll -->
            <div class="product-container" id="product-container">
                <!-- Loader -->
                <div id="loader">
                    <div class="spinner"></div>
                </div>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="javascript/product.js"></script>

    </body>
</html>