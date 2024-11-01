<?php
session_start();

if ($_SESSION['role'] != 'user') {
    header('Location: login.php');
    exit;
}

include 'connection.php';

$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username'";
 $result = mysqli_query($conn, $sql);
 $user = mysqli_fetch_assoc($result);


// Initialize search variables
$search_result = [];

if (isset($_POST['search'])) {
    $reg_number = $_POST['reg_number'];

    $sql = "SELECT * FROM inmate WHERE reg_number = '$reg_number'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $search_result[] = $row;
       
        }
    } else {
        echo '
        <script>
        alert("User not found with such credentials.");
        window.location.href="user_dashboard.php";
        </script>
        ';
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Inmate Search</title>
    <style>
  
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        height: 100vh;
        overflow: hidden;
        background-color: #f4f4f9;
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
    .main-section {

        margin-left: 20%;
        width: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('images/index.jfif');
        background-size: cover;
        background-position: center;
        padding: 40px;
    }

    .content-container {
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        color: white;
        text-align: center;
    }

    h2 {
        color: orangered;
        margin-bottom: 30px;
    }

    .input-field {
        width: 100%;

        padding: 20px 45px 12px 20px;
        margin-left:70px;
        margin-bottom: 6px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 16px;
        background-color:black;
        opacity:0.5;
        color:white;
    }

    .input-container {
        position: relative;
        display: flex;
        flex-direction:row;
        width: 80%;
        bottom:50%;
        padding-top:  175px;

    }

    .search-icon {
        position: absolute;
        right: 20px;
        top: 175px;
        transform: translateY(50%);
        width: 25px;
        height: 25px;
        
        cursor: pointer;
       
       
    }

    
    .result-card {
        background-color: #3b3b4f;
        color: white;
        margin-top: 20px;
        padding: 18px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .result-card:hover {
        transform: scale(1.02);
    }

    .result-card img {
        width: 350px;
        height: 200px;
        border-radius: 10px;
        margin-bottom: 15px;
        border: 2px solid orangered;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .result-card h3 {
        margin-bottom: 10px;
        color: orangered;
    }

    .result-card p {
        margin: 5px 0;
        color: #f4f4f9;
        font-size: 15px;
    }
   
@media (max-width: 768px) {
    body {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        box-shadow: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
    }

    .sidebar img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }

    .sidebar a {
        width: 100%;
        text-align: center;
        padding: 10px;
        margin: 5px 0;
        font-size: 16px;
        background-color: #323554;
    }

    .sidebar a:hover {
        background-color: orangered;
    }

    .icon {
        margin-right: 10px;
    }

    .main-section {
        width: 100%;
        margin-left: 0;
        padding: 20px;
        background-size: cover;
        background-position: center;
    }

    .content-container {
        width: 100%;
        padding: 20px;
    }

    .input-container {
        flex-direction: column;
        width: 100%;
        align-items: center;
        padding-top: 20px;
    }

    .input-field {
        width: 100%;
        margin: 0;
        padding: 15px;
    }

    .search-icon {
        position: relative;
        top: 10px;
        right: auto;
    }

    .result-card {
        width: 100%;
        margin: 10px 0;
    }
}
.avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid lightgreen;
        display: block;
        float: right;
        right: 0;
        top:20px;
        position: absolute;
        margin-right:30px;

    }
    .result-card {
    position: relative; 
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #3b3b4f;
    opacity:0.8;
    margin: 10px;
}

.cancel-btn {
    position: absolute;
    top: 5px; 
    right: 5px; 
    background-color: white;
    color: orangered;
    border: none;
    font-size: 20px;
    cursor: pointer;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
}

.cancel-btn:hover {
    background-color: orangered;
    color: white;
}
    </style>
</head>

<body>

    <div class="sidebar" style="background-color: #2c2c3e;">

        <img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
        <div class="spacer" style='height:5px'>

        </div>
        <a href="user_profile.php">
            <img src="icons/person.png" alt="Dashboard" class="icon"> My Profile
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="request_visit.php">
            <img src="icons/visit.png" alt="Add Inmate" class="icon"> visitation
        </a>
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="staffs.php">
            <img src="icons/staff.png" alt="Add Staff" class="icon"> Staffs
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="#">
            <img src="icons/chat.png" alt="Add Inmate Movements" class="icon">Inquiries
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="logout.php" onclick="return confirm('Are You sure you want to LogOut?')">
            <img src="icons/logout.png" alt="Logout" class="icon"> Logout
        </a>
    </div>


    <div class="main-section">
        <div class="content-container">
          
       
        
        <h3 class="welcome-message" id="welcomeMessage"></h3>
        <a href="user_profile.php">

<div>
    <img src="<?php echo $user['user_profile_picture'] && file_exists($user['user_profile_picture']) ? $user['user_profile_picture'] : 'icons/person.png'; ?>"
        class="avatar" alt="Avatar">
</div>
</a>

        
        <form method="POST">
                <div class="input-container">
                    <input type="text" name="reg_number" id="reg_number" class="input-field"  placeholder="Enter Inmate Registration Number" required/>


                        <button type="submit" name="search" style=" border: none; background-color:red; display:block">
                        <img src="icons/search.png" alt="Search Icon" class="search-icon">
                    </button>
                </div>
            </form>

            <?php if (!empty($search_result)) { ?>
            <?php foreach ($search_result as $inmate) { ?>

            <div class="result-card" id="result-box">
                <button class="cancel-btn"  onclick="cancelBox()">&times;</button>
                <?php if (!empty($inmate['image_path'])) { ?>
                <img src="<?php echo $inmate['image_path']; ?>" alt="Inmate Image">
                <?php } else { ?>
                <img src="icons/person.png" alt="Default Image">
                <?php } ?>
                <h3>Inmate ID: <?php echo $inmate['id']; ?></h3>
                <p><strong>First Name:</strong> <?php echo $inmate['first_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $inmate['last_name']; ?></p>
                <p><strong>Crime:</strong> <?php echo $inmate['offense']; ?></p>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <script>
    const message = `Welcome, <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?>! find an Inmate`;
    let index = 0;

    function typeText() {
        if (index < message.length) {
            document.getElementById("welcomeMessage").innerHTML += message.charAt(index);
            index++;
            setTimeout(typeText, 100);
        } else {
            
            setTimeout(() => {
                document.getElementById("welcomeMessage").innerHTML = ""; 
                index = 0; 
                typeText(); 
            }, 5000); 
        }
    }

    typeText(); 



//cancel result box

function cancelBox() {

    var resultBox = document.getElementById('result-box');
    resultBox.style.display = "none";
}


</script>

</body>

</html>