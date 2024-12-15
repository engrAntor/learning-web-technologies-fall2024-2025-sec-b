<?php
session_start();

// Dummy user data for example (replace this with database queries)
$users = [
    'user1' => ['password' => 'password123', 'name' => 'John Doe', 'email' => 'john@example.com'],
    'user2' => ['password' => 'password456', 'name' => 'Jane Smith', 'email' => 'jane@example.com']
];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists and password matches
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Store user information in session
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $users[$username]['name'];
        $_SESSION['email'] = $users[$username]['email'];

        // Redirect to the homepage
        header('Location: home.php');
        exit;
    } else {
        echo 'Invalid username or password.';
    }
}
?>
