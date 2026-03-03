<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: user_page.php');
    exit();
}

// Fetch data for the dashboard
// Here you can add your own logic to fetch data
$usersCount = 100; // Example data
$postsCount = 250; // Example data

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Navigation</h2>
        <ul>
            <li><a href="admin_page.php">Dashboard</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_posts.php">Manage Posts</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Admin Dashboard</h1>
        <p>Total Users: <?php echo $usersCount; ?></p>
        <p>Total Posts: <?php echo $postsCount; ?></p>
    </div>
</body>
</html>