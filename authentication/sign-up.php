<?php
session_start();
include 'include/db_connect.php';

$firstname = $lastname = $email = $phone = $address = $username = "";
$message = "";
$redirect = false;

if (isset($_POST['create'])) {
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);
    $username  = trim($_POST['username']);
    $password  = $_POST['password'];
    // password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validate email quickly
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address";
    } else {
        // Prepare check statement
        $check_sql  = "SELECT id FROM users WHERE email = ? OR username = ?";
        $check_stmt = $conn->prepare($check_sql);

        if($check_stmt) {
            $check_stmt->bind_param("ss", $email, $username);
            $check_stmt->execute();
            $check_stmt->store_result();

            if($check_stmt->num_rows > 0) {
                $message = "⚠️ Email or username already exists. Please choose another.";
                $email = "";
                $username = "";
                $password = "";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql  = "INSERT INTO users (firstname, lastname, email, phone, address, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if($stmt) {
                    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $address, $username, $hash);
                    if($stmt->execute()) {
                        $message = "✅ Successfully registered! Redirecting to login...";
                        $redirect = true;
                    } else {
                        $message = "❌ Registration failed. Please try again later.";
                    }

                    $stmt->close();
                }
            }
            $check_stmt->close();
        } else {
            $message = "Server error. Please try again later.";
        }
    }

    $conn->close();
}
?>
