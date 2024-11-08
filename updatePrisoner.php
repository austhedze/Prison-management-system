<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    $id = $_GET['updateID'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $offense = $_POST['offense'];
    $sentence_years = $_POST['sentence_years'];
    $court_appearances = $_POST['court_appearances'];
    $release_date = $_POST['release_date'];
    $pleaded_guilty = $_POST['pleaded_guilty']; 
    $updated_by = $_SESSION['username'] ?? 'unknown_user'; // Get the logged-in user's username or set a default

    // Retrieve current data for comparison
    $sql = "SELECT * FROM inmate WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $current_data = mysqli_fetch_assoc($result);

    // Prepare update query
    $sql = "UPDATE inmate SET first_name='$first_name', last_name='$last_name', sex='$sex', age='$age', 
            offense='$offense', sentence_years='$sentence_years', court_appearances='$court_appearances', 
            release_date='$release_date', pleaded_guilty='$pleaded_guilty' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql)) {
        // Log the changes if the update is successful
        $fields_to_check = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'sex' => $sex,
            'age' => $age,
            'offense' => $offense,
            'sentence_years' => $sentence_years,
            'court_appearances' => $court_appearances,
            'release_date' => $release_date,
            'pleaded_guilty' => $pleaded_guilty
        ];

        foreach ($fields_to_check as $field => $new_value) {
            $old_value = $current_data[$field];
            if ($old_value != $new_value) {
                // Log only if there's a change
                $log_sql = "INSERT INTO inmate_update_log (inmate_id, field_updated, old_value, new_value, updated_by) 
                            VALUES ('$id', '$field', '$old_value', '$new_value', '$updated_by')";
                mysqli_query($conn, $log_sql);
            }
        }

        echo '
        <script>
        alert("Prisoner information updated successfully!");
        window.location.href="admin.php";
        </script>
        ';
    } else {
        die("Error updating record: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inmate data</title>
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

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input,
        .input-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            outline: none;
        }

        .input-group input[type="radio"] {
            width: auto;
        }

        .input-group label[for="guilty_yes"],
        .input-group label[for="guilty_no"] {
            display: inline-block;
            margin-left: 10px;
        }

        .button-group {
            grid-column: span 2;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color:  #001f3f;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }

            .button-group {
                grid-column: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container">
    <h2>Update Inmate Information</h2>

        <form method="POST">
            

            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="input-group">
                <label for="sex">Sex</label>
                <select id="sex" name="sex" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    
                </select>
            </div>

            <div class="input-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="input-group">
                <label for="offense">Offense</label>
                <input type="text" id="offense" name="offense" required>
            </div>

            <div class="input-group">
                <label for="sentence_years">Sentence (Years)</label>
                <input type="number" id="sentence_years" name="sentence_years" required>
            </div>

            <div class="input-group">
                <label for="court_appearances">Court Appearances</label>
                <input type="number" id="court_appearances" name="court_appearances" required>
            </div>

            <div class="input-group">
                <label for="release_date">Release Date</label>
                <input type="date" id="release_date" name="release_date" required>
            </div>

            <div class="input-group">
                <label for="pleaded_guilty">Did the inmate plead guilty?</label>
                <input type="radio" id="guilty_yes" name="pleaded_guilty" value="yes" required>
                <label for="guilty_yes">Yes</label>

                <input type="radio" id="guilty_no" name="pleaded_guilty" value="no" required>
                <label for="guilty_no">No</label>
            </div>

            <div class="button-group">
                <button type="submit" name="submit">Update Inmate</button>
            </div>
        </form>
    </div>

</body>

</html>
