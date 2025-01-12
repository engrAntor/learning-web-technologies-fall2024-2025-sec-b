<?php
// Database Connection
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

// Handle CRUD Operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $name = $_POST['name'];
        $contact_no = $_POST['contact_no'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO employees (name, contact_no, username, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $contact_no, $username, $password]);
        echo "Employee added successfully!";
    }

    if ($action == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $contact_no = $_POST['contact_no'];

        $stmt = $conn->prepare("UPDATE employees SET name = ?, contact_no = ? WHERE id = ?");
        $stmt->execute([$name, $contact_no, $id]);
        echo "Employee updated successfully!";
    }

    if ($action == 'delete') {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
        $stmt->execute([$id]);
        echo "Employee deleted successfully!";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM employees WHERE name LIKE ?");
    $stmt->execute(["%$search%"]);
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($employees);
}
?>
