<!-- include/db_connect.php -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sneaker_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Connect failed:" . $conn->connect_error);
}
?>