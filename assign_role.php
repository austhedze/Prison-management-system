<?php
include "connection.php";
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $role = $_POST["role"];

    // Check if the user exists
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // Update the role
        $updateRoleQuery = "UPDATE users SET role = '$role' WHERE username = '$username'";
        
        if ($conn->query($updateRoleQuery) === TRUE) {
            //echo "Role updated successfully for $username.";
            echo "<script>
            alert('Role for  $username, updated successfully.');
            window.location.href='assign_role.php';
            </script>";
        } else {
            echo "Error updating role: " . $conn->error;
        }
    } else {
        echo "<script>
        alert('Oops! No user with such username was found');
        </script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Role</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #ddd;
        }
        .dashboard-container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c2c3e;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 20px;
            margin: 0 auto;
            display: block;
        }
        .sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 5px; 
    flex-grow:1;
}

        .sidebar-nav a {
            color: #ddd;
            text-decoration: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #3c3c4e;
            border-radius: 8px;
        }
        .sidebar-nav a:hover {
            background-color: orangered;
        }
        .nav-icon {
            width: 30px; 
            height: 30px; 
            vertical-align: middle;
        }
        .main-content {
            flex-grow: 1;
            padding: 55px;
            background-color: #262637;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 500px;
            background-color: #333348;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            padding: 40px;
            text-align: center;
        }
        .card h2 {
            margin-top: 0;
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            color: #bbb;
            font-size: 14px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #555;
            background-color: #2a2a3d;
            color: #fff;
            font-size: 14px;
            margin-top: 5px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: orangered;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #e67300;
        }
        .profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: none;
        display: block;
        float: right;
        right: 0;
        top:0;
        position: absolute;

    }

    </style>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <img src="images/logo.jpg" alt="Logo">
            </div>
            <div class="spacer" style="height:80px"></div>
            <nav class="sidebar-nav">
                <a href="reports.php">
                    <img src="icons/dash.png" alt="Dashboard Icon" class="nav-icon"> Dashboard
                </a>
                <div class="spacer" style="height:60px"></div>
                <a href="admin_profile.php">
                    <img src="icons/person.png" alt="Profile Icon" class="nav-icon"> My Profile
                </a>
                <div class="spacer" style="height:60px"></div>
                <a href="admin.php">
                    <img src="icons/logs.png" alt="Logs Icon" class="nav-icon"> Logs
                </a>
                <div class="spacer" style="height:60px"></div>
                <a href="logout.php" onclick="return confirm('You are about to be signed-out, continue?')" style="position:fixed; bottom:5px; width:200px">
                    <img src="icons/logout.png" alt="Logout Icon" class="nav-icon"> Logout
                </a>
            </nav>
        </aside>

        <main class="main-content">
        <div>
                    <img src="<?php echo $main_admin['main_admin_profile_picture'] && file_exists($main_admin['main_admin_profile_picture']) ? $main_admin['main_admin_profile_picture'] : 'icons/person.png'; ?>"
                        class="avatar" alt="Avatar">
                </div>
            <div class="card">
                <h2>Assign Role to User</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" id="role" required>
                            <option value="user">Ordinary User</option>
                            <option value="admin">Admin</option>
                            <option value="main_admin">Main Admin</option>
                            <option value="visitation_manager">Visitation Manager</option>
                        </select>
                    </div>
                    <button type="submit">Assign Role</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>

