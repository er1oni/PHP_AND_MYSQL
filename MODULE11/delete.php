<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM users EHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()){
        echo "user seleted sucesfully";
    }else{
        echo "error deleting the user";
    // 
}


?>