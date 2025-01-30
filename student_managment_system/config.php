<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_managment_system";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo "Database connected successfully!";
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>