<?php

include_once("config.php");

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome to Admin Dashboard</h2>
    <p>Admin Username: <?php echo $_SESSION['admin_username']; ?></p>
    <ul>
        <li><a href="manage_students.php">Manage Students</a></li>
        <li><a href="manage_teachers.php">Manage Teachers</a></li>
        <li><a href="manage_classes.php">Manage Classes</a></li>
        <li><a href="attendance.php">Track Attendance</a></li>
        <li><a href="fees.php">Manage Fees</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
