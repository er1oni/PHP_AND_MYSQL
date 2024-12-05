<?php
include'db.php';

//fetch all users from the databse
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare ($sql);
$stmt->execute();
$users = $stmt->fetchALL(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USERS DASHBOARD</title>
    <style>
        /* css */
    </style>
</head>
<body>
<h2>users dashboard</h2>
<table>
    <thead>
        <tr>
            <th>username</th>
            <th>email</th>
            <th>actions</th>
        </tr>
    </thead>
</table>
<tbody>
    <!--  -->
</tbody>
</body>
</html>