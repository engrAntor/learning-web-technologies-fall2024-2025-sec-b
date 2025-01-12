<?php
include('db_connection.php'); // Database connection file

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $sql = "SELECT * FROM employees WHERE name LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    echo json_encode($employees);
}
?>
