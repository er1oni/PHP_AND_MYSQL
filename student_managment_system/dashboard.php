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
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
        }
        h2 {
            text-align: center;
            margin-top: 50px;
            font-size: 3rem;
            letter-spacing: 2px;
        }
        .dashboard {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #333;
        }
        .card p {
            font-size: 3rem;
            font-weight: bold;
            color: #4e73df;
            margin: 0;
        }
        .card.total {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
            color: white;
        }
        .card.passed {
            background: linear-gradient(135deg, #28a745 0%, #3bbd7d 100%);
            color: white;
        }
        .card.failed {
            background: linear-gradient(135deg, #dc3545 0%, #e93e55 100%);
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Management Dashboard</h2>

    <div class="dashboard">
        <!-- Total Students Card -->
        <div class="card total">
            <h3>Total Students</h3>
            <p><?php echo $total_students; ?></p>
        </div>

        <!-- Passed Students Card -->
        <div class="card passed">
            <h3>Passed Students</h3>
            <p><?php echo $pass_count; ?></p>
        </div>

        <!-- Failed Students Card -->
        <div class="card failed">
            <h3>Failed Students</h3>
            <p><?php echo $fail_count; ?></p>
        </div>
    </div>
</div>

</body>
</html>
