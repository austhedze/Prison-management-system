<?php
include 'connection.php';
session_start();

// Ensure the user is logged in and has the right permissions
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'warder') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['deleteID'])) {
    $id = intval($_GET['deleteID']); // Ensure the ID is an integer to prevent injection
    $admin_username = mysqli_real_escape_string($conn, $_SESSION['username']); // Escape admin username
    $ip_address = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']); // Escape IP address

    // Delete the inmate record
    $sql = "DELETE FROM `inmate` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {

        
        
        // Log the deletion in the deletion_logs table
        $log_query = "INSERT INTO deletion_logs (admin_username, inmate_id, ip_address) VALUES ('$admin_username', $id, '$ip_address')";
        mysqli_query($conn, $log_query);
        
        echo '<script>
        alert("Prisoner Successfully deleted.");
        window.location.href="warder.php";
        </script>';
    } else {
        die("Error deleting record: " . mysqli_error($conn));
    }
}
?>
