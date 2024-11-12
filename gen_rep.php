<?php
include "connection.php";

// Query to get total offenses, gender breakdown, and total staff count
$totalOffensesQuery = "SELECT COUNT(offense) AS total_offenses FROM inmate";
$genderQuery = "SELECT sex, COUNT(*) AS gender_count FROM inmate GROUP BY sex";
$totalStaffQuery = "SELECT COUNT(id) AS total_staff FROM staffmanagement";

$totalOffensesResult = $conn->query($totalOffensesQuery);
$genderResult = $conn->query($genderQuery);
$totalStaffResult = $conn->query($totalStaffQuery);

// Fetch results for offenses, gender, and staff count
$totalOffenses = $totalOffensesResult->fetch_assoc()['total_offenses'];
$genderCounts = [];
while ($row = $genderResult->fetch_assoc()) {
    $genderCounts[$row['sex']] = $row['gender_count'];
}
$totalStaff = $totalStaffResult->fetch_assoc()['total_staff'];

// Query to fetch visitation logs
$visitationLogsQuery = "SELECT id, inmate_name, visitor_name, visit_date, visit_time, status, reason, created_at, username FROM visits";
$visitationLogsResult = $conn->query($visitationLogsQuery);

// Retrieve inmate addition logs
$additionLogsQuery = "SELECT * FROM inmate_addition_logs ORDER BY date_added DESC";
$additionLogsResult = mysqli_query($conn, $additionLogsQuery);

// Generate HTML content
$htmlContent = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Inmate and Staff Report with Visitation and Addition Logs</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; color: #333; }
        h1, h2 { color: #2c3e50; }
        h1 { font-size: 2em; margin-bottom: 10px; }
        h2 { font-size: 1.5em; margin-top: 30px; color: #34495e; }
        p { font-size: 1.1em; color: #555; }
        
        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.9em; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 14px; text-align: left; }
        th { background-color: #2980b9; color: white; font-weight: bold; }
        td { background-color: #ecf0f1; }
        tr:nth-child(even) td { background-color: #e0eaf1; }
        tr:hover td { background-color: #d1ecf1; }
        
        /* Table Borders */
        th, td { border-bottom: 1px solid #bdc3c7; }
        
        /* Footer */
        footer { margin-top: 40px; font-size: 0.9em; text-align: center; color: #777; }
    </style>
</head>
<body>
    <h1>Inmate and Staff Report</h1>
    <p><strong>Total Inmates:</strong> $totalOffenses</p>
    <p><strong>Total Staff:</strong> $totalStaff</p>
    
    <h2>Gender Breakdown</h2>
    <table>
        <tr><th>Gender</th><th>Count</th></tr>";

// Append gender data to the table
foreach ($genderCounts as $gender => $count) {
    $htmlContent .= "<tr><td>$gender</td><td>$count</td></tr>";
}

$htmlContent .= "
    </table>
    <h2>Visitation Logs</h2>";

// Check if there are visitation logs
if ($visitationLogsResult->num_rows > 0) {
    $htmlContent .= "
    <table>
        <tr>
            <th>ID</th>
            <th>Inmate Name</th>
            <th>Visitor Name</th>
            <th>Visit Date</th>
            <th>Visit Time</th>
            <th>Status</th>
            <th>Reason</th>
            <th>Created At</th>
            <th>Visitor Username</th>
        </tr>";
    
    // Append visitation log data to the table
    while ($row = $visitationLogsResult->fetch_assoc()) {
        $htmlContent .= "
        <tr>
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
    $htmlContent .= "</table>";
} else {
    $htmlContent .= "<p>No visitation logs found.</p>";
}

// Add inmate addition logs
$htmlContent .= "
    <h2>Inmate Addition Logs</h2>";

if (mysqli_num_rows($additionLogsResult) > 0) {
    $htmlContent .= "
    <table>
        <tr>
            
            <th>Reg Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date and Time Added</th>
            <th>Added By</th>
        </tr>";

    
    while ($row = mysqli_fetch_assoc($additionLogsResult)) {
        $htmlContent .= "
        <tr>
            
            <td>" . htmlspecialchars($row['reg_number']) . "</td>
            <td>" . htmlspecialchars($row['first_name']) . "</td>
            <td>" . htmlspecialchars($row['last_name']) . "</td>
            <td>" . htmlspecialchars($row['date_added']) . "</td>
            <td>" . htmlspecialchars($row['added_by']) . "</td>
        </tr>";
    }
    $htmlContent .= "</table>";
} else {
    $htmlContent .= "<p>No inmate addition logs found.</p>";
}

$htmlContent .= "
    <footer>
        <p>Generated by Prison Information Management System &copy; " . date("Y") . "</p>
    </footer>
</body>
</html>";


$conn->close();

// Download HTML file
header('Content-type: text/html');
header('Content-Disposition: attachment; filename="report.html"');
echo $htmlContent;
exit;
?>
