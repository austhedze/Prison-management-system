<?php
include 'connection.php';
session_start();

if ($_SESSION['role'] != 'warder') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username' AND role='warder'";
 $result = mysqli_query($conn, $sql);
 $warder = mysqli_fetch_assoc($result);


 // Fetch total inmates
$inmateCountQuery = "SELECT COUNT(*) AS total_inmates FROM inmate";
$inmateCountResult = mysqli_query($conn, $inmateCountQuery);
$inmateCount = mysqli_fetch_assoc($inmateCountResult)['total_inmates'];

// Fetch total staff
$staffCountQuery = "SELECT COUNT(*) AS total_staff FROM staffmanagement";
$staffCountResult = mysqli_query($conn, $staffCountQuery);
$staffCount = mysqli_fetch_assoc($staffCountResult)['total_staff'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warder Panel - Prison Management System</title>
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
        background-color: #323554;
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





    /*----------------*/
    .card-container {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 15px;
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

    .card h2,
    .card p {
        margin: 10px 0;
        color: #323554;

    }

    .card p {
        font-size: 14px;

        line-height: 1.5;

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

    .button.add {
        background-color: #4CAF50;
        color: white;
    }

    .button.delete {
        background-color: orangered;
        color: white;
    }

    .button.update {
        background-color: #323554;
        color: white;
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

    .stat-card {
        flex: 1;
        background-color: #3c3c4e;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        color: #f58a42;
    }

    .stats {
        display: flex;
        gap: 20px;
        padding: 20px 0;
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
    </style>
    <link rel="stylesheet" href="pixels/openBox.css" type="text/css"/>
    
</head>

<body>


    <div class="sidebar" style="background-color: #2c2c3e;">

        <img src='images/logo.jpg' style='width: 100px; height:100px; border-radius:45px'>
        <div class="spacer" style='height:50px'>

        </div>
        <a href="#">
            <img src="icons/dash.png" alt="Dashboard" class="icon"> Dashboard
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="adduser.php">
            <img src="icons/addinmate.png" alt="Add Inmate" class="icon"> Add Inmate
        </a>
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="add_staff.php">
            <img src="icons/staff.png" alt="Add Staff" class="icon"> Add Staff
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="add_inmate_movements.php">
            <img src="icons/movement.png" alt="Add Inmate Movements" class="icon">Inmate Movements
        </a>
        <div class="spacer" style='height:30px'></div>
        <a href="logout.php" onclick="openConfirmBox(event)">
            <img src="icons/logout.png" alt="Logout" class="icon"> Logout
        </a>
    </div>

    <div class="main-content" style='  background-color: #1e1e2f;'>

        <div class="admin-header">

            <div class="header-text">

                <h2>Welcome Warden, <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?> !</h2>
            </div>
            <a href="warder_profile.php">

                <div>
                    <img src="<?php echo $warder['warder_profile_picture'] && file_exists($warder['warder_profile_picture']) ? $warder['warder_profile_picture'] : 'icons/person.png'; ?>"
                        class="avatar" alt="Avatar">
                </div>
            </a>
        </div>


        <!---------start cards--------->

        <section class="stats">
            <div class="stat-card">
                <h3>Total Inmates</h3>
                <p><?php echo $inmateCount; ?></p>

            </div>
            <div class="stat-card">
                <h3>Total Staff</h3>
                <p><?php echo $staffCount; ?></p>
            </div>
        </section>


        <h1 class="section-title" style="font-size: 30px;color:grey; text-align: LEFT;">Case Management</h1>

        <div class="spacer" style='height:20px'></div>
       
       
        <div class="card">
       
             <table>
                <tr>
                    <th>photo</th>
                    <th>Inmate Name</th>
                    <th>Offense</th>
                    <th>Original Sentence</th>
                    <th>Sentence After Reduction</th>
                    <th>Court Appearances</th>
                    <th>Reg.no</th>
                    <th>Release Date</th>
                    <th>Operations</th>
                </tr>
                <tbody>
                    <?php
                // Fetch inmate data with court appearance, sentence, and release date logic
                $sql = "SELECT * FROM `inmate`";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $offense = $row['offense'];
                        $sentence_years = $row['sentence_years'];
                        $age = $row['age'];
                        $gender = $row['sex'];
                        $court_appearances = $row['court_appearances'];
                        $release_date = $row['release_date'];
                        $pleaded_guilty = $row['pleaded_guilty']; 
                        $reg_number = $row['reg_number'];
                        $photo_path = $row['image_path']; 

                        // Apply sentence reduction rules
                        $reduced_sentence = $sentence_years;
                        if ($age >= 50 && $offense != 'rape' && $offense != 'murder') {
                            $reduced_sentence = $sentence_years / 2;
                        } elseif ($gender == 'female') {
                            $reduced_sentence = $sentence_years / 2;
                        }

    // Apply reduction for pleading guilty (sentence slashed by a quarter)
    if ($pleaded_guilty == 'yes') {
        $reduced_sentence = $reduced_sentence * 0.75; // Reduce by 25%
    }


                        echo '<tr>
                        <td>  <img src="' . $photo_path . '" alt="Staff Image" style="width:50px; height:50px"></td>
                            <td>' . $first_name . ' ' . $last_name . '</td>
                            <td>' . $offense . '</td>
                            <td>' . $sentence_years . ' years</td>
                            <td>' . $reduced_sentence . ' years</td>
                            <td>' . $court_appearances . '</td>
                             <td>' . $reg_number . '</td>
                            <td>' . $release_date . '</td>
                            <td>

                    <a href="deleteUser.php?deleteID='.$id.'"><button class="button delete">delete</button></a>
                     <a href="updatePrisoner.php?updateID='.$id.'"><button class="button update">Update</button></a>
                    </td>

                    </tr>';
                    }
                    } else {
                    die(mysqli_error($conn));
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>


     <!---THE SECTION FOR INMATE MANAGEMENT---->
     <div class="main-content" id='inmate_management'>
        <h1 style="color:grey">Inmate Movements Overview</h1>

        <div class="card">
          
           
            <table>
                <tr>
                <th>photo</th>
                    <th>Inmate Name</th>
                    <th>Disciplinary Records</th>
                    <th>Previous Cell</th>
                    <th>New Cell</th>
                    <th>Reason for Transfer</th>
                    <th>Operations</th>
                </tr>
                <tbody>
                    <?php
                    // Fetch inmate data along with disciplinary records and movements
                    $sql = "SELECT * FROM inmateManagement";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $inmate_name = $row['inmate_name'];
                            $disciplinary_records = $row['disciplinary_records'];
                            $previous_cell = $row['previous_cell'];
                            $new_cell = $row['new_cell'];
                            $transfer_reason = $row['transfer_reason'];
                            $inmate_image = $row['inmate_image']; 

                            echo '<tr>
                            <td> <img src="' . $inmate_image . '" alt="Staff Image" style="width:50px; height:50px"></td>
                                <td>' . $inmate_name . '</td>
                                <td>' . $disciplinary_records . '</td>
                                <td>' . $previous_cell . '</td>
                                <td>' . $new_cell . '</td>
                                <td>' . $transfer_reason . '</td>
                                <td>
                                    <a href="delete_movement.php?deleteID=' . $id . '"><button class="button delete">Delete</button></a>
                                    <a href="update_movement.php?updateID=' . $id . '"><button class="button update">Update</button></a>
                                </td>
                            </tr>';
                        }
                    } else {
                        die(mysqli_error($conn));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>




    <!------------STAFF MANAGEMENT SECTION-------------->
    <div class="main-content" id='staff-id'>
    <h2 style="color:grey">Staff Management</h2>
    <div class="card">

    <table style="left:20px; width:100%">
        <tr>
            <th>photo</th>
            <th>firstName</th>
            <th>lastName</th>
            <th>Role</th>
            <th>Age</th>
            <th>Gender</th>
            <!-- <th>Phone</th> -->
            <th>Email</th>
            <th>Hire Date</th>
            <th>Operations</th>
        </tr>
        <tbody>
            <?php
            // Fetch staff data
            $sql = "SELECT * FROM staffManagement";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    //$full_name = $row['first_name'] . ' ' . $row['last_name'];
                    $row['first_name'];
                    $row['last_name'];
                    $role = $row['role'];
                    $age = $row['age'];
                    $gender = $row['gender'];
                    // $phone = $row['phone'];
                    $email = $row['email'];
                    $hire_date = $row['hire_date'];
                    $photo_path = $row['image_path'];

                    echo '<tr>
                <td> <img src="' . $photo_path . '" alt="Staff Image" style="width:50px; height:50px"></td>
                     <td>' . $first_name . '</td>
                       <td>' . $last_name . '</td>
                        <td>' . $role . '</td>
                        <td>' . $age . '</td>
                        <td>' . $gender . '</td>
                        
                        <td>' . $email . '</td>
                        <td>' . $hire_date . '</td>
                        <td>
                            <a href="delete_staff.php?deleteID='.$id.'"><button class="button delete">Delete</button></a>
                            <a href="update_staff.php?updateID='.$id.'"><button class="button update">Update</button></a>
                        </td>
                    </tr>';
                }
            } else {
                die(mysqli_error($conn));
            }
            ?>
        </tbody>
    </table>
</div>
    </div>

<!-- Custom confirmation modal -->
<div id="confirmModal" class="modal">
  <div class="modal-content">
    <p>You are about to sign out. Continue?</p>
    <button onclick="confirmAction()">Yes</button>
    <button onclick="closeConfirmBox()">No</button>
  </div>
</div> 
<script>
    
function confirmAction() {
  // Redirect to the desired page
  window.location.href = "logout.php";
}
</script>
<script src="scripts/openBox.js"></script>
</body>

</html>