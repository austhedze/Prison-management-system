<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $inmate_name = $_POST['inmate_name'];
    $disciplinary_records = $_POST['disciplinary_records'];
    $previous_cell = $_POST['previous_cell'];
    $new_cell = $_POST['new_cell'];
    $transfer_reason = $_POST['transfer_reason'];


// Image upload handling
$target_dir = "uploads/"; // folder  where images will be saved

$target_file = $target_dir . basename($_FILES["inmate_image"]["name"]);

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if the uploaded file is an image
$check = getimagesize($_FILES["inmate_image"]["tmp_name"]);
if ($check !== false) {
    // Move the uploaded file to the server

    if (move_uploaded_file($_FILES["inmate_image"]["tmp_name"], $target_file)) {

        
        $sql = "INSERT INTO inmateManagement (inmate_name, disciplinary_records, previous_cell, new_cell, transfer_reason, image_path) 
                VALUES ('$inmate_name', '$disciplinary_records', '$previous_cell', '$new_cell', $transfer_reason,  '$target_file')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '
            <script>
            alert("Prisoner information added successfully with image!");
            window.location.href="admin_dashboard2.php";
            </script>
            ';
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        echo "Sorry, there was an error uploading the image.";
    }
} else {
    echo "File is not an image.";
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inmate Movement</title>
    <link href="pixels/add_inmate_movements.css" rel="stylesheet" type="text/css" />
    <style>

        </style>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h2>Add Inmate Movement</h2>

            <div class="input-group">
                <label for="inmate_name">Inmate Name</label>
                <input type="text" id="inmate_name" name="inmate_name" required>
            </div>

            <div class="input-group">
                <label for="disciplinary_records">Disciplinary Records</label>
                <textarea id="disciplinary_records" name="disciplinary_records" required></textarea>
            </div>

            <div class="input-group">
                <label for="previous_cell">Previous Cell</label>
                <input type="text" id="previous_cell" name="previous_cell" required>
            </div>

            <div class="input-group">
                <label for="new_cell">New Cell</label>
                <input type="text" id="new_cell" name="new_cell" required>
            </div>

            <div class="input-group">
                <label for="transfer_reason">Reason for Transfer</label>
                <textarea id="transfer_reason" name="transfer_reason" required></textarea>
            </div>
            <div class="input-group">
                    <label for="inmate_image">Inmate Image</label>
                    <input type="file" id="inmate_image" name="inmate_image" accept="image/*" required>
                </div>
            <div class="button-group">
                <button type="submit" name="submit">Add Inmate Movement</button>
            </div>
        </form>
    </div>
</body>

</html>
