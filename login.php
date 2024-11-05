<?php
include 'connection.php';
session_start();

// Define lockout settings
define('MAX_ATTEMPTS', 3);
define('LOCKOUT_TIME', 2 * 60); // 2 minutes in seconds

// Initialize session variables for tracking failed attempts
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
    $_SESSION['lockout_time'] = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Check if user is locked out
    if ($_SESSION['failed_attempts'] >= MAX_ATTEMPTS) {
        $time_since_lockout = time() - $_SESSION['lockout_time'];
        if ($time_since_lockout < LOCKOUT_TIME) {
            // Display lockout message if still in lockout period
            $remaining_lockout = LOCKOUT_TIME - $time_since_lockout;
            echo '<script>
                alert("Account is locked. Try again in ' . ceil($remaining_lockout / 60) . ' minutes.");
                window.location.href="login.php";
            </script>';
            exit;
        } else {
            // Reset failed attempts after lockout period
            $_SESSION['failed_attempts'] = 0;
            $_SESSION['lockout_time'] = null;
        }
    }

    // Query the database for user credentials
    $query = "SELECT id, password, role FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Successful login, reset failed attempts
            $_SESSION['failed_attempts'] = 0;
            $_SESSION['lockout_time'] = null;

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            // Log successful login
            $log_query = "INSERT INTO login_attempts (username, status, ip_address) VALUES ('$username', 'success', '$ip_address')";
            mysqli_query($conn, $log_query);

            // Redirect based on user role
            if ($row['role'] == 'admin') {
                header('Location: reports.php');
            } elseif ($row['role'] == 'warder') {
                header('Location: warder.php');
            } elseif ($row['role'] == 'visitation_manager') {
                header('Location: visitation_dashboard.php'); 
            } else {
                header('Location: user_dashboard.php');
            }
            exit;
        } else {
            // Failed login attempt
            $_SESSION['failed_attempts'] += 1;

            // Log failed login
            $log_query = "INSERT INTO login_attempts (username, status, ip_address) VALUES ('$username', 'failed', '$ip_address')";
            mysqli_query($conn, $log_query);

            if ($_SESSION['failed_attempts'] >= MAX_ATTEMPTS) {
                $_SESSION['lockout_time'] = time();
                echo '<script>
                    alert("Too many failed attempts. Account is locked for 2 minutes.");
                    window.location.href="login.php";
                </script>';
            } else {
                echo '<script>
                    alert("Invalid Password! Attempt ' . $_SESSION['failed_attempts'] . ' of ' . MAX_ATTEMPTS . '");
                    window.location.href="login.php";
                </script>';
            }
        }
    } else {
        // Log failed login for non-existent user
        $log_query = "INSERT INTO login_attempts (username, status, ip_address) VALUES ('$username', 'failed', '$ip_address')";
        mysqli_query($conn, $log_query);

        echo '<script>
            alert("No user was found with such credentials!");
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
