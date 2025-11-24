<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session completely
session_destroy();

// Optional: destroy session cookie (for extra safety)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Redirect to login page
header("Location: login.php?message=logged_out");
exit();
?>
