<?php
$servername = "localhost";
$username = "your_username"; //  database username
$password = "your_password"; //  database password
$dbname = "your_dbname"; //  database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
