<?php
include 'connection.php';

session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$username = $_SESSION['username'];

if (isset($_POST['request'])) {
    $inmate_name = $_POST['inmate_name'];
    $visitor_name = $_POST['visitor_name'];
    $visit_date = $_POST['visit_date'];
    $visit_time = $_POST['visit_time'];

    // Insert the visit request into the database
    $sql = "INSERT INTO visits (inmate_name, visitor_name, visit_date, visit_time, username, status)
            VALUES ('$inmate_name', '$visitor_name', '$visit_date', '$visit_time', '$username', 'Pending')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '
        <script>
        alert("Your Visit Request has been successfully sent.");
        window.location.href="request_visit.php";
        </script>
        ';
    } else {
        die("Something went wrong: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Visit</title>
    <link href="pixels/admin.css" rel="stylesheet" type="text/css" />
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #2c2c3e;
        margin: 0;
        padding: 0;
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
        width: 20px;
        height: 20px;
        margin-right: 20px;
        margin-top: 20px;
    }

    .main-content {
        margin-left: 270px;
        padding: 40px;
        background-color: #2c2c3e;
    }

    .container {
        background-color: #323554;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 10px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
        display: block;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .button-group {
        text-align: center;
        margin-top: 20px;
    }

    .button-group button {
        background-color: #2c2c3e;
        color: white;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-group button:hover {
        background-color: #388E3C;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }

    table th,
    table td {
        padding: 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    table tr:hover {
        background-color: black;
        opacity: 0.5;
    }

    table td {
        color: #333;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
        }

        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            text-align: left;
            padding: 10px;
        }

        .sidebar img {
            width: 70px;
            height: 70px;
        }
    }

    .icon {
        width: 45px;
        height: 45px;
        margin-right: 5px;
        vertical-align: middle;
    }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="images/logo.jpg" style="margin-left: 80px; width: 100px; height: 100px; border-radius: 45px;">
        <div class="spacer" style="height: 20px;"></div>
        <a href="user_dashboard.php">
            <img src="icons/home.png" alt="My Visit Requests Icon" class="icon"> Home
        </a>
        <div class="spacer" style="height: 30px;"></div>
        <a href="#request_visit">
            <img src="icons/request.png" alt="Visit Icon" class="icon"> Request Visit
        </a>
        <div class="spacer" style="height: 20px;"></div>
        <a href="#my_visit_request">
            <img src="icons/request.png" alt="My Visit Requests Icon" class="icon"> My Visit Requests
        </a>
        <div class="spacer" style="height: 20px;"></div>
        <a href="logout.php" onclick="return alert('Are you sure you want to sign-out?')">
            <img src="icons/logout.png" alt="Logout Icon" class="icon"> Logout
        </a>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <section id="request_visit">
        <div class="container">
            <form method="POST">
                <h2 style='color:grey'>Request a Visit</h2>

                <div class="input-group">
                    <label for="inmate_name" style='color:#fff'>Inmate Name</label>
                    <input type="text" id="inmate_name" name="inmate_name" required>
                </div>

                <div class="input-group">
                    <label for="visitor_name" style='color:#fff'>Your Name</label>
                    <input type="text" id="visitor_name" name="visitor_name" required>
                </div>

                <div class="input-group">
                    <label for="visit_date" style='color:#fff'>Preferred Visit Date</label>
                    <input type="date" id="visit_date" name="visit_date" required>
                </div>

                <div class="input-group">
                    <label for="visit_time" style='color:#fff'>Preferred Visit Time</label>
                    <input type="time" id="visit_time" name="visit_time" required>
                </div>

                <div class="button-group">
                    <button type="submit" name="request" style='color:#fff; background-color:orangered'>Request
                        Visit</button>
                </div>
            </form>
        </div>
        </section>

        <!-- Visit Requests Table -->
         <section id="my_visit_request">
        <div class="container">
            <h2 style='color:grey'> My Visit Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Inmate Name</th>
                        <th>Visit Date</th>
                        <th>Visit Time</th>
                        <th>Status</th>
                        <th>Reason for rejection</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch visit requests for the logged-in user
                    $sql = "SELECT * FROM visits WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr style="color:white">
                                    <td style="color:white">' . $row['visitor_name'] . '</td>
                                    <td style="color:white">' . $row['inmate_name'] . '</td>
                                    <td style="color:white">' . $row['visit_date'] . '</td>
                                    <td style="color:white">' . $row['visit_time'] . '</td>
                                    <td style="color:white">' . $row['status'] . '</td>
                                    <td style="color:white">' . $row['reason'] . '</td>
                                  </tr>';
                        }
                    } else {
                        die("Error fetching data: " . mysqli_error($conn));
                    }
                    ?>
                </tbody>
            </table>
        </div>
                </section>
    </div>

</body>

</html>