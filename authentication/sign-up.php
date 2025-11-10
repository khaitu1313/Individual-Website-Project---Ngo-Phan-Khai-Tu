<?php
session_start();
include 'include/db_connect.php';

if (isset($_POST['create'])) {
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);
    $username  = trim($_POST['username']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validate email quickly
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.');</script>";
    } else {
        // Prepare check statement
        $check_sql  = "SELECT id FROM users WHERE email = ? OR username = ?";
        $check_stmt = $conn->prepare($check_sql);

        if ($check_stmt === false) {
            // prepare() failed
            error_log("Prepare failed: " . $conn->error);
            echo "<script>alert('Server error. Please try again later.');</script>";
        } else {
            $check_stmt->bind_param("ss", $email, $username);
            $check_stmt->execute();

            // Use store_result() + num_rows - compatible without mysqlnd
            $check_stmt->store_result();

            if ($check_stmt->num_rows > 0) {
                // email or username already exists
                echo "<script>alert('⚠️ Email or username already exists. Please choose another.');</script>";
            } else {
                $sql  = "INSERT INTO users (firstname, lastname, email, phone, address, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    error_log("Prepare failed: " . $conn->error);
                    echo "<script>alert('Server error. Please try again later.');</script>";
                } else {
                    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $address, $username, $password);
                    $result = $stmt->execute();

                    if ($result) {
                        echo "<script>alert('✅ Successfully registered!');</script>";
                    } else {
                        error_log("Insert failed: " . $stmt->error);
                        echo "<script>alert('❌ Registration failed. Please try again later.');</script>";
                    }
                }
            }

            // Close check statement
            $check_stmt->close();
        }

        // Close insert statement if it exists
        if (isset($stmt) && $stmt instanceof mysqli_stmt) {
            $stmt->close();
        }
    }

    // Close connection
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
