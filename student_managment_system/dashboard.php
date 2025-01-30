<?php

include_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Fetch total students
$total_students = $conn->query("SELECT COUNT(*) FROM students")->fetchColumn();

// Fetch pass and fail count
$pass_count = $conn->query("SELECT COUNT(*) FROM students WHERE grade >= 'C'")->fetchColumn();
$fail_count = $conn->query("SELECT COUNT(*) FROM students WHERE grade < 'C'")->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .dashboard { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .card { border: 1px solid black; padding: 20px; width: 200px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Student Management Dashboard</h2>
    <div class="dashboard">
        <div class="card">
            <h3>Total Students</h3>
            <p><?php echo $total_students; ?></p>
        </div>
        <div class="card">
            <h3>Passed Students</h3>
            <p><?php echo $pass_count; ?></p>
        </div>
        <div class="card">
            <h3>Failed Students</h3>
            <p><?php echo $fail_count; ?></p>
        </div>
    </div>
</body>
</html>
