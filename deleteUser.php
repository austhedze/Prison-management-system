<?php

include 'connection.php';

if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];

    $sql = "delete from `inmate` where id=$id";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo '<script>
        alert("Prisoner Successfully deleted:");
        window.location.href="admin_dashboard.php";
        </script>';
     
    } 
    else {
        die(mysqli_error($conn));
    }
}


?>