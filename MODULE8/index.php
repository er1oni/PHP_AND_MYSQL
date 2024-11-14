<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = "testtest";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

    // $sql = "CREATE TABLE users (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // username VARCHAR(30) NOT NULL,
    // password VARCHAR(30) NOT NULL )";

    // $pdo -> exec($sql);

    // echo "table vreated sucesfully!!!";

    //Sert values to be inserted
    $username = "Jack";

    $password = password_hash( "mypassword", PASSWORD_DEFAULT);

    // insert statment for SQL
    $sql = "INSERT INTO users(username, password) VALUES ('$username', 'password')";

    $pdo -> exec($sql);

    echo "New record createtd sucesfully,";

}catch(Exception $e){
    echo "Error creating table:  ". $e->getMessage();
}

?>