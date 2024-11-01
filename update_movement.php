<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $id = $_GET['updateID'];
    $inmate_name = $_POST['inmate_name'];
    $disciplinary_records = $_POST['disciplinary_records'];
    $previous_cell = $_POST['previous_cell'];
    $new_cell = $_POST['new_cell'];
    $transfer_reason = $_POST['transfer_reason'];

    $sql = "UPDATE inmateManagement SET inmate_name = '$inmate_name', disciplinary_records='$disciplinary_records', previous_cell='$previous_cell', new_cell='$new_cell', transfer_reason='$transfer_reason' WHERE id='$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
        alert('Inmate Movement Added Successfully');
         window.location.href='admin_dashboard.php';</script>";
    } else {
        die(mysqli_error($conn));
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inmate Movement</title>
    <link href="pixels/admin.css" rel="stylesheet" type="text/css" />
    <style>
  
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 15px;
    }


    .label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

   
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    textarea {
        resize: vertical;
    }

 
    .button-group {
        text-align: center;
    }


    button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #5c67f2;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #4b54d6;
    }

  
    @media (max-width: 600px) {
        .container {
            width: 95%;
            padding: 10px;
        }

        button {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST">
            <h2>Update Inmate Movement</h2>

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

            <div class="button-group">
                <button type="submit" name="submit">Update Inmate Movement</button>
            </div>
        </form>
    </div>
</body>

</html>