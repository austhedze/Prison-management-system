<?php
session_start();
if ($_SESSION['role'] != 'visitation_manager') {
    header('Location: login.php');
    exit;
}

include 'connection.php';

// Approve or reject a visit
if (isset($_POST['visit_request'])) {
    $visit_id = $_POST['visit_id'];

    if ($_POST['visit_request'] == 'approve') {
        $sql = "UPDATE visits SET status='approved' WHERE id='$visit_id'";
    } elseif ($_POST['visit_request'] == 'reject') {
        $reason = $_POST['reason'];
        $sql = "UPDATE visits SET status='rejected', reason='$reason' WHERE id='$visit_id'";
    }

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitation Management</title>
    <link href="pixels/visitation.css" rel="stylesheet" type="text/css" />
    <style>
   
    body {
        font-family: Arial, sans-serif;
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
        width: 30px;
        height: 30px;
        margin-right: 20px;
        margin-top: 20px;
    }

    .main-content {
        margin-left: 270px;
        padding: 30px;
    }

    .card {
        width: 90%;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        margin-left: 50px;
    }

    h2 {
        color: #2c3e50;
    }

    h3 {
        color: #2980b9;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #dddddd;
        text-align: left;
    }

    th {
        background-color: #2980b9;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    button {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background-color: #27ae60;
    }

    input[type="text"] {
        padding: 5px;
        margin-left: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    </style>

</head>

<body>
     <div class="sidebar">
        <img src="images/logo.jpg" alt="Logo">
        <div class="spacer" style="height: 50px;"></div>

        <a href="#">
            <img src="icons/visit.png" alt="Dashboard" class="icon"> Visitation
        </a>
     
        <a href="#">
            <img src="icons/manage1.png" alt="Manage Visits" class="icon"> Manage Visits
        </a>
        <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">
            <img src="icons/logout.png" alt="Logout" class="icon"> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2 style='margin-left:50px ; color:grey'>Visitation Management</h2>

        <div class="card">
            <h3>Manage Visit Request</h3>
            <table>
                <tr>
                    <th>Inmate Name</th>
                    <th>Visitor Name</th>
                    <th>Visit Date</th>
                    <th>Visit Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM visits WHERE status='pending'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($row['inmate_name']) . '</td>
                                    <td>' . htmlspecialchars($row['visitor_name']) . '</td>
                                    <td>' . htmlspecialchars($row['visit_date']) . '</td>
                                    <td>' . htmlspecialchars($row['visit_time']) . '</td>
                                    <td>' . htmlspecialchars($row['status']) . '</td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="visit_id" value="' . $row['id'] . '">
                                            <button type="submit" name="visit_request" value="approve" onclick="return confirm(\'Are You Sure You Want to Approve this Request?\')">Approve</button>
                                        </form>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="visit_id" value="' . $row['id'] . '">
                                            <input type="text" name="reason" placeholder="Reason for rejection" required>
                                            <button type="submit" name="visit_request" value="reject" style="background-color:orangered">Reject</button>
                                        </form>
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
</body>

</html>