<?php
include('db_connection.php'); // Database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Store hashed password

    $query = "INSERT INTO employees (name, contact_no, username, password) VALUES ('$name', '$contact_no', '$username', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['message' => 'Employee added successfully!']);
    } else {
        echo json_encode(['message' => 'Error adding employee: ' . mysqli_error($conn)]);
    }
}
?>
