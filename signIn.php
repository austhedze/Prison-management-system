<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, password, role FROM users WHERE username = '$username'";
    
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            // Redirect based on user role
            if ($row['role'] == 'admin') {
                header('Location: admin.php');
            } elseif ($row['role'] == 'warder') {
                header('Location: warder.php');
            }elseif ($row['role'] == 'visitation_manager') {
                header('Location: visitation_dashboard.php'); 
            } else {
                header('Location: user_dashboard.php');
            }
            
            exit;



        } else {
            echo '<script>
            alert("Invalid Password!");
            window.location.href="login.php";
            </script>';
        }
    } else {
        echo '<script>
        alert("No user was Found With such Credentials!");
        window.location.href="login.php";
        </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management System - Login/</title>
    <link rel="stylesheet" href="pixels/login.css" type="text/css">
</head>
<style>
   
</style>
<body>

     <div class="auth-card">
        <h1>Prison Management Login</h1>

    <form method='POST'>
        
    <input type="text" id="username" placeholder="Username" name="username">
        <input type="password" id="password" placeholder="Password" name="password">

        
        <button type="submit">Login</button>
    </form>

        <a href="register.php" class="toggle-link">Don't have an account? Register here</a>
    </div>

</body>
</html>
