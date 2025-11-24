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
        <?php
            include 'include/navbar.php';
            include 'include/db_connect.php';
            include 'authentication/sign-up.php';
        ?>
        

        <main class="#">
            <form action="register.php" method="post">
                <div class="registration-container">
                    <h3>Create Account</h3>

                    <label class="firstname">First Name</label>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>

                    <label class="lastname">Last Name</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"  required>

                    <label class="email">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"  required>

                    <label class="phone">Phone</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"  required>

                    <label class="address">Address</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>"  required>

                    <label class="username">User Name</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>"  required>

                    <label class="password">Password</label>
                    <input type="password" name="password" required>

                    <input type="submit" name="create" value="Sign Up">
                </div>
            </form>

            <div class="container signin">
                <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </div>

            <div id="register-data"
                data-message="<?php echo htmlspecialchars($message); ?>"
                data-redirect="<?php echo $redirect ? 'true' : 'false'; ?>">
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <!-- Javascript Linking -->
        <script src="javascript/register.js"></script>

    </body>
</html>