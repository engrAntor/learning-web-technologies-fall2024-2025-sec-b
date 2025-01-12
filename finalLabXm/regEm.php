<?php
// Database connection
$host = 'localhost';
$dbname = 'shop_management';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables
$error_message = "";
$success_message = "";

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Input validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $error_message = "Username already exists. Please choose another.";
        } else {
            // Insert new admin into the database
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);
            $success_message = "Registration successful! You can now <a href='loginFi.php'>log in</a>.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <h1>Admin Registration</h1>

    <?php if (!empty($error_message)): ?>
        <div style="color: red;"><?= $error_message ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div style="color: green;"><?= $success_message ?></div>
    <?php else: ?>
        <form action="regEm.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
    <?php endif; ?>

    <p>Already have an account? <a href="loginFi.php">Log in here</a>.</p>
</body>
</html>
