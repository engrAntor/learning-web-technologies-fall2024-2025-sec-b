<?php
include('db_connection.php'); // Database connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM employees WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['message' => 'Employee deleted successfully!']);
    } else {
        echo json_encode(['message' => 'Error deleting employee: ' . mysqli_error($conn)]);
    }
}
?>
