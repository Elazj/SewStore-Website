<?php
session_start();
include 'db_conn.php'; // Database connection

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $username = $_SESSION['username'];

    // Fetch user details from the database
    $sql = "SELECT username, email FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<p>Username: " . $row["username"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
} else {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit;
}
