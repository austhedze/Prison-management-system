<?php
include 'connection.php';

session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username'";
 $result = mysqli_query($conn, $sql);
 $user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staffs</title>
    <style>
        
        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .card h2, .card p {
            margin: 10px 0;
            color: #323554;
        }
        .card .actions {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }
        .card .button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .button.add { background-color: #4CAF50; color: white; }
        .button.delete { background-color: orangered; color: white; }
        .button.update { background-color: #323554; color: white; }
        h1.section-title {
            font-size: 24px;
            color: grey;
            font-weight: bold;
            margin: 20px 0;
            text-align: left;
            display: block;
        }
        .sidebar {
            width: 20%;
            height: 100vh;
            background-color: #2c2c3e;
            float: left;
            padding: 20px;
            color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 4px;
            background-color: #323554;
        }
        .sidebar a:hover { background-color: orangered; }
        .main-content {
            margin-left: 25%;
            padding: 20px;
            background-color: #1e1e2f;
        }

    .sidebar .icon {
        width: 30px;
        height: 30px;
        margin-right: 20px;

    }
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid lightgreen;
        display: block;
        float: right;
       right:0;
       margin-right:30px;
        top:20px;
        position: absolute;

    }

    </style>
</head>
<body>

<div class="sidebar">
    <img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
    <div class="spacer" style='height:50px'></div>
    <a href="user_dashboard.php">
        <img src="icons/home.png" alt="Dashboard" class="icon"> Home
    </a>
    <div class="spacer" style='height:30px'></div>
    <!-- <a href="user_profile.php">
        <img src="icons/person.png" alt="Add Inmate" class="icon"> My Profile
    </a>
    <div class="spacer" style='height:30px'></div>
    <a href="visit_request.php">
        <img src="icons/visit.png" alt="Add Staff" class="icon"> Visitation
    </a> -->
    <div class="spacer" style='height:30px'></div>
   
    <div class="spacer" style='height:30px'></div>
    <a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')" style="position:fixed;width:250px; bottom:0">
        <img src="icons/logout.png" alt="Logout" class="icon"> Logout
    </a>
</div>

<div class="main-content">
    <h1 class="section-title">Available Active Staff Members</h1>
    

    <a href="user_profile.php">
<div>
    <img src="<?php echo $user['user_profile_picture'] && file_exists($user['user_profile_picture']) ? $user['user_profile_picture'] : 'icons/person.png'; ?>"
        class="avatar" alt="Avatar">
</div>
</a>

    <div class="card-container">
        <?php
        $sql = "SELECT * FROM `staffManagement`";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $first_name = $row['staff_first_name'];
                $last_name = $row['last_name'];
                $role = $row['role'];
                $age = $row['age'];
                $gender = $row['gender'];
                $phone = $row['phone'];
                $email = $row['email'];
                $hire_date = $row['hire_date'];
                $photo_path = $row['image_path'];

                echo '<div class="card">
                    <img src="' . $photo_path . '" alt="Staff Image">
                    <h2>' . $first_name . ' ' . $last_name . '</h2>
                    <p><strong>Role:</strong> ' . $role . '</p>
                    <p><strong>Age:</strong> ' . $age . '</p>
                    <p><strong>Phone:</strong> ' . $phone . '</p>
                    <p><strong>Email:</strong> ' . $email . '</p>
                    
                   
                </div>';
            }
        } else {
            echo "No staff data available.";
        }
        ?>
    </div>
</div>

</body>
</html>
