<?php
// Must load auth first
include 'include/auth.php';

// Get user session info
$username = $_SESSION['username'] ?? null;
$role = $_SESSION['role'] ?? null;
?>