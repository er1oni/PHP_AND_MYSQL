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

// Fetch passed students count
$pass_count = $conn->query("SELECT COUNT(*) FROM students WHERE status = 'passed'")->fetchColumn();

// Fetch failed students count
$fail_count = $conn->query("SELECT COUNT(*) FROM students WHERE status = 'failed'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            text-align: center;
            padding: 40px;
        }
        .dashboard {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .card {
            background: white;
            padding: 25px;
            width: 220px;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            cursor: pointer;
            text-align: center;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #555;
            margin-top: 10px;
        }
        .total { border-top: 5px solid #007bff; }
        .passed { border-top: 5px solid #28a745; }
        .failed { border-top: 5px solid #dc3545; }
    </style>
</head>
<body>

    <h2>Student Management Dashboard</h2>

    <div class="dashboard">
        <div class="card total" onclick="window.location.href='students_list.php?filter=all'">
            <h3>Total Students</h3>
            <p><?php echo $total_students; ?></p>
        </div>
        <div class="card passed" onclick="window.location.href='students_list.php?filter=passed'">
            <h3>Passed Students</h3>
            <p><?php echo $pass_count; ?></p>
        </div>
        <div class="card failed" onclick="window.location.href='students_list.php?filter=failed'">
            <h3>Failed Students</h3>
            <p><?php echo $fail_count; ?></p>
        </div>
    </div>

</body>
</html>
