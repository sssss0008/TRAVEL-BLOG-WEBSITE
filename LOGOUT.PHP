<!-- logout.php -->
<?php
// Start the session
session_start();

// Check if user is logged in (if session variable is set)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="logout-container">
        <h1>You have been logged out!</h1>
        <p>Thank you for visiting. You will be redirected to the login page shortly.</p>
        <form method="POST" action="logout.php">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
