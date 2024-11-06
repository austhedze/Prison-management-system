<?php
include 'connection.php';
session_start();

// Ensure only admin can view this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Clear logs if the button is clicked
if (isset($_POST['clear_logs'])) {
    $delete_sql = "DELETE FROM deletion_logs";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('All logs have been cleared successfully.');
         window.location.href='delete_logs.php';</script>";
    } else {
        echo "<script>alert('Error clearing logs: " . mysqli_error($conn) . "');</script>";
    }
}

// Retrieve deletion logs
$deletion_log_query = "SELECT * FROM deletion_logs ORDER BY deletion_time DESC";
$deletion_result = mysqli_query($conn, $deletion_log_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletion Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 24px;
        }

        .table-container {
            width: 80%;
            margin: 30px auto;
            overflow-x: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
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
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        button:hover {
            background-color: #c82333;
        }

        .center-text {
            text-align: center;
        }

        @media (max-width: 768px) {
            .table-container {
                width: 95%;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<h1>Deletion Logs</h1>
<div class="table-container">
    <form method="post">
        <button type="submit" name="clear_logs">Clear Logs</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Admin Username</th>
                <th>Inmate ID</th>
                <th>IP Address</th>
                <th>Deletion Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($deletion_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['admin_username']); ?></td>
                    <td><?php echo htmlspecialchars($row['inmate_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['deletion_time']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
