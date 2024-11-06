<?php
session_start();
include 'connection.php';

// Clear logs if the button is clicked
if (isset($_POST['clear_logs'])) {
    $delete_sql = "DELETE FROM inmate_update_log";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('All logs have been cleared successfully.');
         window.location.href='update_logs.php';</script>";
    } else {
        echo "<script>alert('Error clearing logs: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch logs from the inmate_update_log table
$sql = "SELECT * FROM inmate_update_log ORDER BY log_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmate Update Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #001f3f;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        button {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inmate Update Logs</h2>
        <form method="post">
            <button type="submit" name="clear_logs" onclick="return confirm('Are you sure want to clear all the Logs?')">Clear Logs</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Inmate ID</th>
                    <th>Field Updated</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                    <th>Updated By</th>
                    <th>Log Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['log_id']}</td>
                                <td>{$row['inmate_id']}</td>
                                <td>{$row['field_updated']}</td>
                                <td>{$row['old_value']}</td>
                                <td>{$row['new_value']}</td>
                                <td>{$row['updated_by']}</td>
                                <td>{$row['log_date']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No logs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
