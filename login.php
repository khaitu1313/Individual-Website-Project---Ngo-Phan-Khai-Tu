<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Sign In</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <!-- Include files linking -->
        <?php
            session_start();

            if (isset($_SESSION['username'])) {
                header("Location: dashboard.php");
                exit;
            }
            include 'include/navbar.php';
            include 'include/db_connect.php';
        ?>

        <main>
            <div class="login-container">

                <!-- LEFT PANEL -->
                <div class="left-panel">
                    <h2>Login</h2>

                    <div class="social-login">
                        <a href="authentication/social_callback.php?provider=google">
                            <img src="images/logo/gg.png" alt="Google Login">
                        </a>

                        <a href="authentication/social_callback.php?provider=facebook">
                            <img src="images/logo/fb.png" alt="Facebook Login">
                        </a>

                        <a href="authentication/social_callback.php?provider=twitter">
                            <img src="images/logo/tt.png" alt="Twitter Login">
                        </a>
                    </div>

                    <form action="authentication/sign-in.php" method="POST">
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input type="username" id="username" name="username" required />
                        </div>

                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required />
                        </div>

                        <button class="login-btn" type="submit">Login</button>
                    </form>

                    <div class="register">
                        Don't have an account? <a href="register.php">Register now</a>
                    </div>
                </div>

                <!-- RIGHT PANEL -->
                <div class="right-panel">
                    <img src="images/login/login.png" alt="Sneaker Image Placeholder">
                </div>

                <!-- LOGIN POP-UP -->
                <div id="popup" class="popup hidden">
                    <div class="popup-box">
                        <span id="popup-icon"></span>
                        <p id="popup-message"></p>
                    </div>
                </div>

            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="javascript/login.js"></script>

    </body>
</html>