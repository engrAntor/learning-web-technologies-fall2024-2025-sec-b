<?php
// Start the session
session_start();

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

// Handle login request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error_message = "Username and password are required!";
    } else {
        // Check credentials in the database
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['username'] = $user['username'];
            header("Location: adDash.php"); // Redirect to the dashboard
            exit();
        } else {
            $error_message = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (!empty($error_message)): ?>
        <div style="color: red;"><?= $error_message ?></div>
    <?php endif; ?>
    <form action="loginFi.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
