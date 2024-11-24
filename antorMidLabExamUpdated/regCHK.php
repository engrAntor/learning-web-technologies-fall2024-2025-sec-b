<?php
session_start();
 
// Initialize the users array if not already set
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = []; // Array to store users
}
 
// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
 
// Check if the email is already registered
foreach ($_SESSION['users'] as $user) {
    if ($user['email'] === $email) {
        die("Email already registered. <a href='register.html'>Go back</a>");
    }
}
 
// Add the new user to the session's users array
$_SESSION['users'][] = [
    'name' => $name,
    'email' => $email,
    'password' => $password
];
 
// Redirect to the login page with a success message
$_SESSION['message'] = "Registration successful. Please log in.";
header("Location: login.html");
exit();
?>