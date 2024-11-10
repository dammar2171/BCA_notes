<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'bca_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
}

.form-container {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 400px; /* Maximum width for the form container */
    margin: 0 auto; /* Centering the container */
    padding: 20px; /* Padding inside the container */
}

label {
    font-weight: bold; /* Bold for labels */
    display: block; /* Each label on a new line */
    margin: 10px 0 5px; /* Spacing around labels */
}

input[type="text"], 
input[type="password"] {
    width: 100%; /* Full width for inputs */
    padding: 10px; /* Padding inside the input fields */
    border: 1px solid #ddd; /* Border style */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
    margin-bottom: 15px; /* Space between fields */
}

button {
    background-color: #007bff; /* Primary button color */
    color: white; /* Text color for button */
    padding: 10px; /* Padding for the button */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    width: 100%; /* Full width for button */
}

button:hover {
    background-color: #0056b3; /* Darker shade on hover */
}

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
