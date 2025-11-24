<?php 
    include 'authentication/load_user.php';
    include 'include/navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }
    ?>

    <main>
        <div class="dashboard-box">
            <h2>Welcome, <?= htmlspecialchars($username) ?> </h2>
            <p>Your role: <strong><?= $role ?></strong></p>

            <hr>

            <?php include 'dashboard/user.php'; ?>

            <?php include 'dashboard/admin.php'; ?>

            <a class="btn" href="logout.php">Logout</a>
        </div>
    </main>

    <?php include 'include/footer.php'; ?>
    <script src="#" defer></script>
</body>
</html>
