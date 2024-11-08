<?php
include 'connection.php';
session_start();

if ($_SESSION['role'] != 'main_admin') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username' AND role='main_admin'";
 $result = mysqli_query($conn, $sql);
 $main_admin = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main admin Panel log buttons  - Prison Management System</title>
    <link href="pixels/admin.css" rel="stylesheet" type="text/css" />
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #1e1e2f;
        margin: 0;
        padding: 0;
    }

    .header {
        background-color: #323554;
        padding: 20px;
        color: white;
        text-align: center;
        position: fixed;
        width: 100%;
        height: 100px;

    }

    .sidebar {
        width: 25%;
        height: 100vh;
        background-color: #2c2c3e;
        float: left;
        padding: 20px;
        color: white;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        transition: width 0.3s;
        position: fixed;
        height: 100%;
        left: 0;
    }

    .sidebar a {
        display: block;
        padding: 10px;
        color: white;

        text-decoration: none;
        margin-bottom: 10px;
        border-radius: 4px;
        background-color: #3c3c4e;
    }

    .sidebar a:hover {
        background-color: orangered;
    }

    .main-content {
        margin-left: 30%;
        padding: 20px;

        transition: margin-left 0.3s;
        background-color: #1e1e2f;
    }

    h1 {
        color: whitesmoke;
    }

    .card {
        background-color: white;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
        margin-bottom: 10px;
    }

    .card table {
        width: 100%;
        border-collapse: collapse;
    }

    .card table,
    .card th,
    .card td {
        border: 1px solid #ddd;
    }

    .card th,
    .card td {
        padding: 10px;
        text-align: left;
    }

    .button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        margin-top: 10px;
    }

    .button.add {
        background-color: green;
    }

    .button.delete {
        background-color: orangered;
    }

    .button.update {
        background-color: #001f3f;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            float: none;
            position: relative;
        }

        .main-content {
            margin-left: 0;
            padding: 10px;
        }
    }

    @media (max-width: 576px) {
        .header {
            font-size: 18px;
        }

        .button {
            padding: 8px 16px;
            font-size: 14px;
        }

        .card {
            padding: 15px;
        }

        .card h2 {
            font-size: 20px;
        }

        .card th,
        .card td {
            font-size: 14px;
        }
    }






    h1.section-title {
        font-size: 24px;
        / color: grey;
        font-weight: bold;

        margin: 20px 0;

        text-align: LEFT;

        display: block;

    }

    .icon {
        width: 45px;

        height: 45px;
        vertical-align: middle;
        margin-right: 8px;
    }

    .admin-header {
        display: flex;
        flex-direction: row;
        gap: 200px;

    }

    .leading-icon {
        height: 50px;
        width: 50px;

    }

    .header-text {
        color: white;
        margin-top: 30px;
    }

    .stats {
    display: flex;
    gap: 20px;
    padding: 20px 0;
    justify-content: flex-start; 
}

.stat-card {
    width: 300px; 
    background-color: #3c3c4e;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    color: #f58a42;
    display: flex;
    flex-direction: row;
    align-items: center;
}

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid lightgreen;
        display: block;
        float: right;
        right: 0;
        position: absolute;

    }
    .stat-card img.icon {
    width: 70px;
    height: 70px;
    margin-right: 10px;
    left:0;
    vertical-align: middle;
}

    </style>
</head>

<body>


    <div class="sidebar" style="background-color: #2c2c3e;">

        <img src='icons/admin.png' style='width: 100px; height:100px; border-radius:45px'>
        <div class="spacer" style='height:50px'>

        </div>
        <a href="#">
            <img src="icons/dash.png" alt="Dashboard" class="icon"> Dashboard
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="main_admin_profile.php">
            <img src="icons/person.png" alt="Add Inmate" class="icon"> My Profile
        </a>
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="staffs.php" onclick="return confirm('You are about to logout, Continue ?')">
            <img src="icons/staff.png" alt="Add Staff" class="icon"> View Staff
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="main_admin.php">
            <img src="icons/reports.png" alt="Add Inmate Movements" class="icon">Analytics
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')">
            <img src="icons/logout.png" alt="Logout" class="icon"> Logout
        </a>
    </div>

    <div class="main-content" style='  background-color: #1e1e2f; padding-right:10px;right:0'>

        <div class="admin-header">

            <div class="header-text">

                <h2>Welcome , <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?> !</h2>
            </div>
            <a href="main_admin_profile.php">

                <div>
                    <img src="<?php echo $main_admin['main_admin_profile_picture'] && file_exists($main_admin['main_admin_profile_picture']) ? $main_admin['main_admin_profile_picture'] : 'icons/person.png'; ?>"
                        class="avatar" alt="Avatar">
                </div>
            </a>
        </div>


        <!---------start cards--------->

        <section class="stats">
        <a href="auth_logs.php" style="text-decoration: none; color: inherit; display:block">
        <div class="stat-card">
            <img src="icons/loginlogs.png" alt="Login Audit logs Icon" class="icon">
            <h3>Login Audit logs</h3>
        </div>
    </a>

    <a href="delete_logs.php" style="text-decoration: none; color: inherit; display:block">
         <div class="stat-card">
            <img src="icons/deletelogs.png" alt="Total Inmates Icon" class="icon">
                <h3>Deletion logs</h3>
            
            </div>
</a>
        </section>



        <section class="stats">
        <a href="adding_logs.php" style="text-decoration: none; color: inherit; display:block">
            <div class="stat-card">
            <img src="icons/addlogs.png" alt="Total Inmates Icon" class="icon">
                <h3>Adding logs</h3>
            
                  </div>
</a>
<a href="visitation_logs.php" style="text-decoration: none; color: inherit; display:block">
            <div class="stat-card">
            <img src="icons/visitation.png" alt="Total Inmates Icon" class="icon">
                <h3>Visitation logs</h3>

            </div>
</a>
        </section>
        <section>
        <a href="update_logs.php" style="text-decoration: none; color: inherit; display:block">
            <div class="stat-card" style="width:655px; justify-content:center; align-items:center">
            <img src="icons/updatelogs.png" alt="Total Inmates Icon" class="icon">
                <h3>Data manipulation logs</h3>

            </div>
</a>
        </section>



        <h1 class="section-title" style="font-size: 30px;color:grey; text-align: LEFT;"></h1>

        <div class="spacer" style='height:20px'></div>









</body>

</html>