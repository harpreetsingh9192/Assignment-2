<?php
$server = 'localhost';
$username = 'root';
$password = '';
$db = "gym_project";
$conn = mysqli_connect($server, $username, $password, $db);
if(!$conn){
    die("Can't connect to the server");
}  
?>