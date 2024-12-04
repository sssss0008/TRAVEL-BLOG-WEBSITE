<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    echo "You need to log in to book a guide.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['user'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $cost = $_POST['cost'];
    $guideId = $_POST['guideId']; // Guide selected by the user

    // Validate the start and end dates
    if (strtotime($startDate) < strtotime(date('Y-m-d'))) {
        echo "Start date cannot be earlier than today.";
        exit;
    }
    if (strtotime($endDate) < strtotime($startDate)) {
        echo "End date must be the same or later than the start date.";
        exit;
    }

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'travel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert booking data into the database
    $stmt = $conn->prepare("INSERT INTO bookings (username, guide_id, start_date, end_date, cost) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sissi", $username, $guideId, $startDate, $endDate, $cost);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
