<!-- include/header.php -->

<nav>
    <a href="index.php" class="logo">Sneaker</a>

    <!-- Hamburger icon for mobile -->
    <!-- <div class="hamburger" id="hamburger">
        &#9776;
    </div> -->

    <div class="nav-links" id="nav-links">
        <a href="index.php">Home</a>

        <div class="dropdown">
            <a href="product.php" class="dropbtn">Products</a>
            <div class="dropdown-content">
                <a href="product.php?brand=Nike">Nike</a>
                <a href="product.php?brand=Air Jordan">Jordan</a>
                <a href="product.php?brand=Puma">Puma</a>
            </div>
        </div>
                
        <div class="dropdown">
            <a href="cart.php" class="dropbtn">Cart</a>
            <div class="dropdown-content">
                <a href="cart.php">View Cart</a>
                <a href="order.php">View Orders</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="login.php" class="dropbtn">Account</a>
            <div class="dropdown-content">
                <a href="register.php">Sign Up</a>
                <a href="login.php">Sign In</a>
            </div>
        </div>
    </div>
</nav>
