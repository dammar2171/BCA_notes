<?php
$conn = new mysqli('localhost', 'root', '', 'bca_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Admin registered successfully!'); window.location.href='admin_login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
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
        p {
    text-align: center; /* Center-align the paragraph */
}

a {
    color: #007bff; /* Link color */
    text-decoration: none; /* Remove underline */
}

a:hover {
    text-decoration: underline; /* Underline on hover */
}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Admin Registration</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Register</button>
        <p>Already have an account?<a href="admin_login.php">login here</a></p>
    </form>
</div>

</body>
</html>
