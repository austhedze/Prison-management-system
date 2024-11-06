 <?php
include 'connection.php';

$sql = "SELECT * FROM inmate_update_log ORDER BY updated_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Inmate Update Logs</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Log ID</th><th>Inmate ID</th><th>Field Updated</th><th>Old Value</th><th>New Value</th><th>Updated At</th><th>Updated By</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['log_id']}</td>
                <td>{$row['inmate_id']}</td>
                <td>{$row['field_updated']}</td>
                <td>{$row['old_value']}</td>
                <td>{$row['new_value']}</td>
                <td>{$row['updated_at']}</td>
                <td>{$row['updated_by']}</td>
             </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No update logs found.</p>";
}

$conn->close();
?> 
