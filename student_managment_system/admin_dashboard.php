<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
include_once("config.php");

// Fetch data
$total_students = $conn->query("SELECT COUNT(*) FROM students")->fetchColumn();
$pass_count = $conn->query("SELECT COUNT(*) FROM students WHERE grade >= 'C'")->fetchColumn();
$fail_count = $conn->query("SELECT COUNT(*) FROM students WHERE grade < 'C'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center text-primary">🎓 Student Management Dashboard</h2>
    
    <div class="row text-center mt-4">
        <div class="col-md-4">
            <div class="card shadow-lg p-3">
                <h4>Total Students</h4>
                <h3 class="text-success"><?= $total_students; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg p-3">
                <h4>Passed Students</h4>
                <h3 class="text-primary"><?= $pass_count; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg p-3">
                <h4>Failed Students</h4>
                <h3 class="text-danger"><?= $fail_count; ?></h3>
            </div>
        </div>
    </div>

    <canvas id="studentChart" class="mt-4"></canvas>

    <div class="text-center mt-4">
        <a href="manage_students.php" class="btn btn-primary">Manage Students</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<script>
    var ctx = document.getElementById('studentChart').getContext('2d');
    var studentChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Passed', 'Failed'],
            datasets: [{
                data: [<?= $pass_count; ?>, <?= $fail_count; ?>],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        }
    });
</script>

</body>
</html>

