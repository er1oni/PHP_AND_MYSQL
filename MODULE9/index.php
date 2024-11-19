<?php
$username = $GET['username'];
$password = $GET['username'];
echo "<br>"
echo $username;
echo "<br>"
echo $password;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" placeholder="username">br
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder=Password><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>