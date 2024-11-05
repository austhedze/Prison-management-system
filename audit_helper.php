<?php
include 'connection.php';
function logAction($user_id, $action_type, $description, $conn) {
    $stmt = "INSERT INTO audit_log (user_id, action_type, description) VALUES (?, ?, ?)";
 $result = mysqli_query($conn, $stmt);
 if($result){
    die('something went wrong '.mysqli($conn));
 }
   
}
