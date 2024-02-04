<?php
session_start();
include 'db_conn.php';

if (isset($_POST['email']) && isset($_SESSION['username'])) {
    $newEmail = $conn->real_escape_string($_POST['email']);
    $username = $_SESSION['username'];

    // Update email query
    $sql = "UPDATE users SET email = '$newEmail' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Email updated successfully.";
    } else {
        echo "Error updating email: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
