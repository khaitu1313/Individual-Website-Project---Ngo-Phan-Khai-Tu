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
        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>

        <main>
            <div class="login-container">

                <!-- LEFT PANEL -->
                <div class="left-panel">
                    <h2>Login</h2>

                    <div class="social-login">
                        <a href="social_login/google.php">
                            <img src="images/logo/gg.png" alt="Google Login">
                        </a>

                        <a href="social_login/facebook.php">
                            <img src="images/logo/fb.png" alt="Facebook Login">
                        </a>

                        <a href="social_login/twitter.php">
                            <img src="images/logo/tt.png" alt="Twitter Login">
                        </a>
                    </div>

                    <form action="login_process.php" method="POST">
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

            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="#"></script>

    </body>
</html>