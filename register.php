<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/register.css">
    </head>
    <body>
        <!-- Include files linking -->
        <?php include 'include/navbar.php'; ?>
        <?php include 'include/db_connect.php'; ?>
        <?php include 'authentication/sign-up.php'; ?>

        <main class="#">
            <form action="register.php" method="post">
                <div class="registration-container">
                    <h3>Register</h3>

                    <label class="firstname">First Name</label>
                    <input type="text" name="firstname" required>

                    <label class="lastname">Last Name</label>
                    <input type="text" name="lastname" required>

                    <label class="email">Email</label>
                    <input type="email" name="email" required>

                    <label class="phone">Phone</label>
                    <input type="text" name="phone" required>

                    <label class="address">Address</label>
                    <input type="text" name="address" required>

                    <label class="username">User Name</label>
                    <input type="text" name="username" required>

                    <label class="password">Password</label>
                    <input type="password" name="password" required>

                    <input type="submit" name="create" value="Sign Up">
                </div>
            </form>

            <div class="container signin">
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="#"></script>

    </body>
</html>