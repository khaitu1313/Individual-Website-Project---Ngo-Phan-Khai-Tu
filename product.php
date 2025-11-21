<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Products</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/product.css">
    </head>
    <body>
        <!-- Include files linking -->
        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>

        <main class="product-page">
            <!-- Sidebar -->
            <aside class="side-bar">
                <h3>Filter & Sort</h3>
                <div class="sort-buttons">
                    <button class="sort-btn active" data-sort="default">Default</button>
                    <button class="sort-btn" data-sort="name_asc">Name (A-Z)</button>
                    <button class="sort-btn" data-sort="name_desc">Name (Z-A)</button>
                    <button class="sort-btn" data-sort="price_asc">Price (Low-High)</button>
                    <button class="sort-btn" data-sort="price_desc">Price (High-Low)</button>
                </div>
            <!-- Search bar -->
                <div class="search-section">
                    <h3>Search</h3>

                    <form class="search-box">
                        <input type="text" placeholder="Search...">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </aside>
            
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