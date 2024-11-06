<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitation Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .clear-button {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .clear-button:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>

<h2>Visitation Logs</h2>

<?php
include 'connection.php';

// Query to fetch visitation logs
$sql = "SELECT id, inmate_name, visitor_name, visit_date, visit_time, status, reason, created_at, visitor_username, user_id, username FROM visits";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Inmate Name</th><th>Visitor Name</th><th>Visit Date</th><th>Visit Time</th><th>Status</th><th>Reason</th><th>Created At</th><th>Username</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['inmate_name']}</td>
                <td>{$row['visitor_name']}</td>
                <td>{$row['visit_date']}</td>
                <td>{$row['visit_time']}</td>
                <td>{$row['status']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['created_at']}</td>
            
                
                <td>{$row['username']}</td>
             </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No visitation logs found.</p>";
}

$conn->close();
?>

<!-- Clear Logs Button Form -->
<form method="POST" action="">
    <button type="submit" name="clear_logs" class="clear-button">Clear Logs</button>
</form>

<?php
// Clear logs functionality
if (isset($_POST['clear_logs'])) {
    include 'connection.php';
    
    // Delete all records from visits table
    $delete_sql = "DELETE FROM visits";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<p>All visitation logs cleared successfully.</p>";
        // Optionally, reset the auto-increment ID
        $conn->query("ALTER TABLE visits AUTO_INCREMENT = 1");
        // Refresh the page to update the table
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<p>Error clearing visitation logs: " . $conn->error . "</p>";
    }
    $conn->close();
}
?>

</body>
</html>
