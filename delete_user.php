<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'bca_db');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Convert to an integer for security

    // Fetch user details before deletion (optional, for logging purposes)
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Delete the user from the database
        $sql = "DELETE FROM users WHERE id=$user_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User deleted successfully!'); window.location.href='user_list.php';</script>";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid user ID.";
}

$conn->close();
?>
