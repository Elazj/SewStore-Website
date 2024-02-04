<?php
include 'db_conn.php'; // Ensure you have a file named db_conn.php with your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    // Check if username or email already exists
    $duplicate = $conn->query("SELECT id FROM users WHERE username = '$username' OR email = '$email'");
    if ($duplicate->num_rows > 0) {
        echo "Username or Email already exists.";
    } else {
        // Password hashing
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "New user registered successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
