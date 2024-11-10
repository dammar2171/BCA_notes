<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'bca_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General styles */
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        nav {
            background-color: #007bff; /* Primary color */
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #0056b3;
        }

        /* Container for the profile */
        .container {
            max-width: 500px;
            margin: 10px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Header styles */
        h2 {
            text-align: center;
            color: #1877f2;
        }

        /* Profile picture styles */
        img {
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #ddd;
        }

        /* Logout link styles */
        p {
            text-align: center;
        }

        p a {
            color: #1877f2;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<nav>
    <a href="user.php">Home</a>
    <a href="manage_profile.php">Manage Profile</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <h2>User Profile</h2>
    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100" height="100">
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
    <p><a href="manage_profile.php">Edit Profile</a></p> <!-- Link to manage profile -->
</div>
</body>
</html>
