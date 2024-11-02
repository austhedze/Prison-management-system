<?php
$host = 'localhost';
$db = 'pmis';
$user = 'root'; 
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if(!$conn){
    
    die(mysqli_error($conn));
}


?>
