<?php
session_start();
include('db_connection.php'); // Include DB connection

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query the database for the admin's username and password
    $query = "SELECT * FROM users WHERE username = '$username' AND role = 'admin'";
    $result = mysqli_query($conn, $query);
    
    // Check if user exists and password is correct
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Set session variables for admin
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            
            // Redirect to the Admin Dashboard
            header('Location: admin_dashboard.php');
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No admin found with that username.";
    }
}
?>
