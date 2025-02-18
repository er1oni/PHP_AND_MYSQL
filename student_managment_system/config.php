<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "student_managment_system";

 try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
     die("Database Connection Failed: " . $e->getMessage());
 }
 ?>




