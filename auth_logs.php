<?php
include 'connection.php';
session_start();

// Ensure only admin can view this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'main_admin') {
    header('Location: login.php');
    exit;
}

// Clear logs if requested
if (isset($_GET['clear_logs']) && $_GET['clear_logs'] == 'true') {
    $clear_login_logs = "DELETE FROM login_attempts";
    $clear_deletion_logs = "DELETE FROM deletion_logs";

    if (mysqli_query($conn, $clear_login_logs) && mysqli_query($conn, $clear_deletion_logs)) {
        echo "<script>alert('Logs cleared successfully.');</script>";
    } else {
        echo "<script>alert('Failed to clear logs.');</script>";
    }
    // Redirect to avoid resubmitting on page refresh
    header("Location: auth_logs.php");
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
    <title>Admin Panel - Login Attempts</title>
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

        /* Define colors for status text */
        .status-success {
            color: green;
            font-weight: bold;
        }

        .status-failed {
            color: red;
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

<h1>Login Attempts</h1>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>Attempt Time</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($login_result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td class="<?php echo trim($row['status']) === 'success' ? 'status-success' : 'status-failed'; ?>">
                        <?php echo htmlspecialchars($row['status']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['attempt_time']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<!-- Clear Logs Button -->
<div style="text-align: center; margin-top: 20px;">
    <a href="?clear_logs=true" onclick="return confirm('Are you sure you want to clear all logs?');">
        <button style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 4px; cursor: pointer;">Clear Logs</button>
    </a>
</div>
</body>
</html>
