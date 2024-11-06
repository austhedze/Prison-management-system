<?php

include 'connection.php';

if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];

    $sql = "delete from `inmatemanagement` where id=$id";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo '<script>
        alert("Inmate Successfully deleted:");
        window.location.href="warder.php";
        </script>';
     
    } 
    else {
        die(mysqli_error($conn));
    }
}


?>