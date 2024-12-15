<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    $hashed_password = hash('sha256', $password);
    $user_data = "$username|$hashed_password\n";
    $file = 'users.txt';

    if (file_put_contents($file, $user_data, FILE_APPEND)) {
        echo "Registration successful! You can <a href='login.html'>login</a>.";
    } else {
        echo "Error in registration.";
    }
}
?>
