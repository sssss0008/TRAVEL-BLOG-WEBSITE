<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $placeName = $_POST['place_name'];

    $conn = new mysqli('localhost', 'root', '', 'travel');
    $stmt = $conn->prepare("INSERT INTO places (name) VALUES (?)");
    $stmt->bind_param("s", $placeName);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header('Location: admin_dashboard.php');
    exit;
}
?>
