<?php
$servername = "localhost";
$username = "root"; // Default username in XAMPP
$password = ""; // Default password in XAMPP (usually empty)
$dbname = "yeshacrud"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
