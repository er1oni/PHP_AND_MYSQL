<?php
//setting MySQL databasa parameters

$host = 'localhost';
$user = 'root';
$pass = '';

//conecting in database using PDO
//Beinning of a try block
try{
    //attemt to create s neq PDO object and connecting to a MySQL database
    //The connecting string is contructed using the variables $host, $user and $pass

    $conn = new PDO("mysql:host=$host; $user; $pass");

    //if the connection is succesful
    echo "connected";
} catch (Exception $e){
    echo "Not Connected";
}
?>