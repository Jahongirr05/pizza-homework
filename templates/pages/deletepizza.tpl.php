<?php
$conn = new mysqli("sql100.infinityfree.com", "if0_41711727", "dushanbe2025", "if0_41711727_pizza_homework");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pname'])) {
    $pname = $_POST['pname'];

    $stmt = $conn->prepare("DELETE FROM pizza WHERE pname=?");
    $stmt->bind_param("s", $pname);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header("Location: ./?crud");
exit;
?>