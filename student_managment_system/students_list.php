<?php

include_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Check if filtering by passed or failed students
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if ($filter == 'passed') {
    $stmt = $conn->prepare("SELECT * FROM students WHERE status = 'passed'");
} elseif ($filter == 'failed') {
    $stmt = $conn->prepare("SELECT * FROM students WHERE status = 'failed'");
} else {
    $stmt = $conn->prepare("SELECT * FROM students");
}

$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 1.2rem;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .passed {
            color: #155724;
        }
        .failed {
            color: #721c24;
        }
        .filter-btns {
            margin-bottom: 20px;
        }
        .filter-btns a {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .filter-btns a:hover {
            background: #2980b9;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .back-btn:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Students List</h2>
    
    <div class="filter-btns">
        <a href="?filter=all">All</a>
        <a href="?filter=passed">Passed</a>
        <a href="?filter=failed">Failed</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Status</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr class="<?= $student['status'] == 'passed' ? 'passed' : 'failed'; ?>">
                <td><?= $student['id']; ?></td>
                <td><?= htmlspecialchars($student['name']); ?></td>
                <td><?= htmlspecialchars($student['class_name']); ?></td>
                <td><?= ucfirst($student['status']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>

