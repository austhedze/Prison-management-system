<?php
$host = 'localhost';
$db = 'PMIS';
$user = 'root'; 
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if(!$conn){
    
    die(mysqli_error($conn));
}


?>
