<?php
include_once("config.php");

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: manage_students.php");
exit();
?>
