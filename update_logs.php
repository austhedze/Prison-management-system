<?php
include 'connection.php';

$sql = "SELECT * FROM update_logs ORDER BY update_time DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Logs</title>
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
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #001f3f;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Logs</h2>
    <table>
        <tr>
            <th>Updater Username</th>
            <th>Updated Username</th>
            <th>Updated Fields</th>
            <th>Update Time</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['updater_username']; ?></td>
                <td><?php echo $row['updated_username']; ?></td>
                <td><?php echo $row['updated_fields']; ?></td>
                <td><?php echo $row['update_time']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
