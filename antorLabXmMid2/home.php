<?php
session_start();

// Redirect to login if the session is not set
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit;
}

// Assuming session contains user details like 'username', 'name', and 'email'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    
    <h2>Your Information:</h2>
    <ul>
        <li><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></li>
        <!-- Add any additional user information you want to display -->
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
