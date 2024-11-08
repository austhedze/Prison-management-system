<?php
session_start();
include 'connection.php';


if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}



$username = $_SESSION['username'];

// Fetch admin details from the database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

// Handle profile update
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $profile_picture = $_FILES['admin_profile_picture'];

    // Upload profile picture
    if ($profile_picture['name']) {
        $target_dir = "Images/";
        $target_file = $target_dir . basename($profile_picture["name"]);
        move_uploaded_file($profile_picture["tmp_name"], $target_file);
    } else {
        // Keep existing picture if not updated
        $target_file = $admin['admin_profile_picture']; 
    }

    // Update admin information
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', admin_profile_picture='$target_file' WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Profile updated successfully!");
        window.location.href="admin.php";
        </script>';
       
        exit;
    } else {
        echo '<script>alert("Error updating profile: ' . mysqli_error($conn) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile update -page </title>
    <style>
    body {
        font-family: Arial, sans-serif;
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
        margin-top: 20px;
    }


    .container {
        display: flex;
        height: 100vh;


    }



    .content {
        width: 80%;
        padding: 30px;
        background-color: #323554;
        overflow-y: auto;
        margin-left: 200px;
    }

    .form-section {
        background-color: #2c2c3e;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 20px auto;
    }

    .avatar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 3px solid #4caf50;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    button {
        background-color: grey;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
    }

    button:hover {
        background-color: red;
    }
    </style>
</head>

<body>

    <div class="container">

        <div class="sidebar" style="background-color: #2c2c3e;">

            <img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
            <div class="spacer" style='height:5px'>

            </div>
            <a href="admin.php">
                <img src="icons/dash.png" alt="Dashboard" class="icon"> Dashboard
            </a>
            <div class="spacer" style='height:30px'></div>
            <a href="adduser.php">
                <img src="icons/add.png" alt="Add Inmate" class="icon"> Add Inmate
            </a>
            </a>
            <div class="spacer" style='height:30px'></div>
            <a href="add_staff.php">
                <img src="icons/staff.png" alt="Add Staff" class="icon"> Add Staff
            </a>
            <div class="spacer" style='height:30px'></div>

            <div class="spacer" style='height:30px'></div>
            <a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')">
                <img src="icons/logout.png" alt="Logout" class="icon"> Logout
            </a>
        </div>


        <div class="content">
            <div class="avatar-container">
                <img src="<?php echo $admin['admin_profile_picture'] ? htmlspecialchars($admin['admin_profile_picture']) : 'icons/person.png'; ?>"
                    class="avatar" alt="Avatar">
            </div>
            <div class="form-section">
                <h2 style="color:grey">Update Profile</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label for="firstname" style="color:whitesmoke">First Name:</label>

                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($admin['firstname']); ?>"
                        required>

                    <label for="lastname" style="color:whitesmoke">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($admin['lastname']); ?>"
                        required>

                    <label for="profile_picture" style="color:whitesmoke">Profile Picture:</label>
                    <input type="file" name="admin_profile_picture">

                    <button type="submit" name="update" style="background-color:grey" id="update-btn">Update
                        Profile</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>