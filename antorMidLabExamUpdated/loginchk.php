<?php
session_start();

// Check if the users array exists
if (!isset($_SESSION['users'])) {
    die("No registered users found. <a href='register.html'>Register</a>");
}

// Check if the form was submitted via POST method and if required data is set
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Verify the credentials
        $loginSuccess = false;
        foreach ($_SESSION['users'] as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                // Correct login: Save user data to session and redirect to the homepage
                $_SESSION['user'] = $user;
                header("Location: homepage.php");
                exit();
            }
        }
        
        if (!$loginSuccess) {
            die("Invalid email or password. <a href='login.html'>Try again</a>");
        }
    } else {
        die("Email or password is missing. <a href='login.html'>Try again</a>");
    }
} else {
    die("Form not submitted.");
}
?>
