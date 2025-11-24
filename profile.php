<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/profile.css">
    </head>

    <body>
        <?php include 'include/navbar.php'; ?>

        <main>
            <div class="profile-container">
                <h2>Change Profile</h2>

                <form id="profileForm">

                    <label>Email</label>
                    <input type="email" name="email" id="email">

                    <label>Phone</label>
                    <input type="text" name="phone" id="phone">

                    <label>Address</label>
                    <input type="text" name="address" id="address">

                    <hr>

                    <label>New Password</label>
                    <input type="password" name="password" id="password">

                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">

                    <button type="submit">Save Changes</button>
                </form>

                <p id="message"></p>
            </div>
        </main>

        <?php include 'include/footer.php'; ?>

        <script src="javascipt/profile.js"></script>
    </body>
</html>
