<?php
include('db_connection.php'); // Database connection file

$query = "SELECT * FROM employees";
$result = mysqli_query($conn, $query);

$employees = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}

echo json_encode($employees);
?>
