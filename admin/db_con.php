<?php
$servername = "localhost:3309"; // Change this if your database is hosted elsewhere
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "theriftify"; // Replace with your MySQL database name

// Create connection

$connection = mysqli_connect('localhost', 'root', 'your_password', 'theriftify');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
mysqli_close($connection);
