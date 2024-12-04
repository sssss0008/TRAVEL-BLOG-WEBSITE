<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'travel');

// Fetch users
$usersQuery = $conn->query("SELECT * FROM users");

// Fetch bookings
$bookingsQuery = $conn->query("SELECT * FROM bookings");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        button { padding: 5px 10px; background-color: red; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>
    
    <h3>Users</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $usersQuery->fetch_assoc()): ?>
            <tr>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <form action="remove_user.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Guide</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $bookingsQuery->fetch_assoc()): ?>
            <tr>
                <td><?= $booking['username'] ?></td>
                <td>Guide <?= $booking['guide_id'] ?></td>
                <td><?= $booking['start_date'] ?></td>
                <td><?= $booking['end_date'] ?></td>
                <td><?= $booking['cost'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Add Place</h3>
    <form action="add_place.php" method="POST">
        <input type="text" name="place_name" placeholder="Place Name" required>
        <button type="submit">Add Place</button>
    </form>

</body>
</html>
