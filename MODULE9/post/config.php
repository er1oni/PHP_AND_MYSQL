<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "my_db_";



try{
    $connect = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);

    // echo  "Connected!!!";
}catch(Exception $e){
    echo "Something went wrong";    
}
?>

