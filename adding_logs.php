<?php
include 'connection.php';
session_start();

// Ensure only admin can view this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}



// Clear logs if requested
if (isset($_GET['clear_logs']) && $_GET['clear_logs'] == 'true') {
    $clear_logs_query = "DELETE FROM inmate_addition_logs";
    if (mysqli_query($conn, $clear_logs_query)) {
        echo "<script>alert('Logs cleared successfully.');</script>";
    } else {
        echo "<script>alert('Failed to clear logs.');</script>";
    }
    // Redirect to avoid re-running on page refresh
    header("Location: adding_logs.php");
    exit;
}


// Retrieve login logs
$log_query = "SELECT * FROM login_attempts ORDER BY attempt_time DESC";
$login_result = mysqli_query($conn, $log_query);

// Retrieve deletion logs
$deletion_log_query = "SELECT * FROM deletion_logs ORDER BY deletion_time DESC";
$deletion_result = mysqli_query($conn, $deletion_log_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Inmate Addition Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-bottom: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #001f3f;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td {
            color: #333;
        }

        /* No logs message styling */
        .no-logs {
            text-align: center;
            color: #666;
            padding: 20px 0;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Inmate Addition Logs</h2>

    <table>
        <tr>
            <th>Log ID</th>
            <th>Reg Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date Added</th>
            <th>Added By</th>
        </tr>

        <?php
        // Fetch all logs from the inmate_addition_logs table
        $sql = "SELECT * FROM inmate_addition_logs";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['log_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['reg_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_added']) . "</td>";
                echo "<td>" . htmlspecialchars($row['added_by']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-logs'>No logs found</td></tr>";
        }
        ?>
    </table>

    <a href="?clear_logs=true" onclick="return confirm('Are you sure you want to clear all logs?');" class="clear-logs-btn">Clear Logs</a>
</div>

</body>
</html>
