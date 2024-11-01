<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $default_role = 'user'; 

    // Compare passwords before hashing
    if($password !== $confirmPassword){
        echo '
        <script>
        alert("Password does not Match!");
        window.location.href="register.php";
        </script>
        ';
        exit;
    }

    // Hash the password after confirmation
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if user already exists
    $check_user_query = "SELECT * FROM users WHERE username = '$username'";
    
    $check_user_result = mysqli_query($conn, $check_user_query);

    if (mysqli_num_rows($check_user_result) > 0) {
        echo '<script>
        alert("User Already Exists");
        window.location.href="register.php";
        </script>';
        exit;
    }

    // Add new user to database
    $sql = "INSERT INTO users (firstname, lastname, username, password, role)
     VALUES ('$firstname', '$lastname', '$username', '$hashedPassword', '$default_role')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>
        alert("You are Successfully Registered!");
        window.location.href= "user_dashboard.php";
        </script>';
        exit;
    } else {
        echo '<script>
        alert("Registration Failed. Please try again.");
        window.location.href= "register.php";
        </script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prison Management System - Signup</title>
    <link rel="stylesheet" href="pixels/register.css" type="text/css">
</head>
<style>
   
</style>
<body>

     <div class="auth-card">
        <h1>Prison Management Signup</h1>

    <form method='POST'>
        <input type="text" id="first-name" placeholder="First Name" name="firstname" required>
        <input type="text" id="last-name" placeholder="Last Name" name="lastname" required>
        <input type="text" id="username" placeholder="Username" name="username" required>
        <input type="password" id="password" placeholder="Password" name="password" required>
        <input type="password" id="confirm-password" placeholder="Confirm Password" name="confirmPassword" required>
        
        <button type="submit" value="submit">Sign Up</button>
    </form>

    <a href="login.php" class="toggle-link">Already have an account? Login here</a>
    </div>

</body>
</html>

