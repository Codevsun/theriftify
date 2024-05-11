<?php
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "theriftify"; // Replace with your MySQL database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
