<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE username = '$username' AND role ='admin'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Profile</title>
    <style>

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f6fa;
    }

    .sidebar {
        width: 20%;
        background-color: #2c2c3e;
        padding: 20px;
        color: white;
        position: fixed;
        height: 100%;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .sidebar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 4px;
        color: white;
        text-decoration: none;
   
        border-radius: 4px;
        background-color: #323554;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .sidebar a:hover {
        background-color: orangered;
    }

    .sidebar .icon {
        width: 30px;
        height: 30px;
        margin-right: 20px;
        margin-top:20px;
    }
    

    .container {
        background:#fff;
        display: flex;
        height: 100vh;
    }



    .content {
        width: 90%;
        padding: 30px;
        overflow-y: auto;
        padding-left:190px;
    }

    .profile-container {
        display: flex;
        background-color: #2c2c3e;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 20px auto;
        height:500px;
    }

    .form-section {
        flex: 1;
        margin-right: 20px;
    }

    .avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 3px solid #4caf50;
        display: block;
        margin-left: auto;
    }

    p {
        margin: 10px 0;
        font-size: 16px;
    }

    .update-btn {
        display: block;
        margin: 20px 0;
        padding: 10px 20px;
        background-color: grey;
        color: white;
        text-align: center;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .update-btn:hover {
        background-color: orangered;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            height: auto;
            padding: 20px;
        }

        .content {
            width: 100%;
        }
    }

    </style>
</head>

<body>

    <div class="container">
   
    <div class="sidebar" style="background-color: #2c2c3e;">

        <img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
        <div class="spacer" style='height:5px'>

        </div>
        <a href="admin_dashboard.php">
            <img src="icons/dash.png" alt="Dashboard" class="icon"> Dashboard
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="request_visit.php">
            <img src="icons/add.png" alt="Add Inmate" class="icon"> Add Inmate
        </a>
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="add_staff.php">
            <img src="icons/staff.png" alt="Add Staff" class="icon">Add  Staff
        </a>
        <div class="spacer" style='height:30px'></div>
        
        <div class="spacer" style='height:30px'></div>
        <a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')">
            <img src="icons/logout.png" alt="Logout" class="icon"> Logout
        </a>
    </div>

       
        <div class="content">
            <div class="profile-container">
                <div class="form-section">
                    <h2 style="color:grey">My Profile Information</h2>
                    <p><strong style="color:grey">Username:</strong> <span style="color:wheat;"><?php echo $user['username']; ?></span></p>
                    <p><strong style="color:grey">First Name:</strong> <span style="color:wheat"><?php echo $user['firstname']; ?></span></p>
                    <p><strong style="color:grey">Last Name:</strong> <span style="color:wheat"><?php echo $user['lastname']; ?></spna></p>
                    <a href="update_admin_profile.php" class="update-btn">Edit Profile</a>
                </div>
                <div>
                    <img src="<?php echo $user['user_profile_picture'] && file_exists($user['user_profile_picture']) ? $user['user_profile_picture'] : 'icons/person.png'; ?>"
                        class="avatar" alt="Avatar">
                </div>
            </div>
        </div>
    </div>

</body>

</html>