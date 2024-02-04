<?php
session_start();
include 'db_conn.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    // Check username in the database
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];

            // Redirect to a new page or display a success message
            echo "Login successful!";
        } else {
            // Password is not correct
            echo "Invalid password.";
        }
    } else {
        // Username doesn't exist
        echo "Invalid username.";
    }

    $conn->close();
}
