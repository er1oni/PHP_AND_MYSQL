<?php
// here we inlude database connection
include_once("Config.php");

//isser() determinates if variable is active and not null
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $username=$_POST['USERNAME'];
    $email=$_POST['email'];
    $sql="INSERT INTO users(name, username, email) VALUES(:name, :username, :email)";
    $sqlQuery=$_connect->prepare($sql);
    $sqlQuery->BindParam(':name', $name);
    $sqlQuery->BindParam(':username', $username);
    $sqlQuery->BindParam(':email', $email);

    $sqlQuery->execute();

    echo"The user was added sucsesfully!";


}
?>