<?php
require_once("config.php");

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = $id";
$sonn->query($sql);

header("location: admin.php");
exit();
?>