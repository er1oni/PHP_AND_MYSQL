<?php

include_once('config.php');

$id = $_GET['id'];

$sql = "DELETE FORM osers WHERE id =:id";

$deleteUser = $conn->prepare($sql);

$deleteUser->bindParam(':id', $id);

$deleteUser->execute();

header("location: dashboard.php");


?>