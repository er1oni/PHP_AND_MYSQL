<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = "new_db";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

    // $sql = "CREATE TABLE IF NOT EXISTS users (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    // username VARCHAR(30) NOT NULL,
    // password VARCHAR(30) NOT NULL )";

    // $pdo -> exec($sql);

    // echo "Table created successfully";

    // Set the values to be inserted
    $username = "Jack";

    $password = password_hash("mypassword", PASSWORD_DEFAULT);

    //Insert statement for SQL
    $sql = "INSERT INTO users(username, password) VALUES ('$username', '$password')";

    //Execute the statement using the exec() method od the PDO object

    $pdo -> exec($sql);


    $last_id = $pdo -> lastInsertId();

    echo " New record created successfully. Last inserted ID IS: ". $last_id;


}catch(PDOException $e){
    // echo "Error creating table:  ". $e->getMessage();
    
    echo $e -> getMessage();
}
?>