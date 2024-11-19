<?php
    //Connect to the database
    try{
    $pdo = new PDO("mysql:host=localhost; dbname=new_db", "root", "");

    $sql = "DROP TABLE users";

    $pdo -> exec($sql);

    echo "Table dropet sucesfully";
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>