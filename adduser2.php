<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $offense = $_POST['offense'];
    $sentence_years = $_POST['sentence_years'];
    $court_appearances = $_POST['court_appearances'];
    $release_date = $_POST['release_date'];
    $pleaded_guilty = ($_POST['pleaded_guilty'] == 'yes') ? 1 : 0;
    $reg_number = $_POST['reg_number'];

    // Image upload handling
    $target_dir = "uploads/"; // Folder where images will be saved
    $target_file = $target_dir . basename($_FILES["inmate_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["inmate_image"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["inmate_image"]["tmp_name"], $target_file)) {
            // Insert data into database, including image path
            $sql = "INSERT INTO inmate (reg_number, first_name, last_name, sex, age, offense, sentence_years, court_appearances, release_date, pleaded_guilty, image_path) 
                    VALUES ('$reg_number', '$first_name', '$last_name', '$sex', $age, '$offense', $sentence_years, $court_appearances, '$release_date', $pleaded_guilty, '$target_file')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '
                <script>
                alert("Prisoner information added successfully!");
                window.location.href="admin_dashboard.php";
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
    <title>Add Inmate</title>
    <link href="pixels/admin.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input,
        .input-group select,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .input-group input:focus,
        .input-group select:focus,
        .input-group textarea:focus {
            border-color: #6c63ff;
            outline: none;
        }

        .button-group {
            grid-column: span 2;
            text-align: center;
        }

        .button-group button {
            background-color: #6c63ff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-group button:hover {
            background-color: #5754d6;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <h2>Add Inmate</h2>

            <div class="form-grid">
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
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" required>
                </div>

                <div class="input-group">
                    <label for="offense">Offense</label>
                    <textarea id="offense" name="offense" required></textarea>
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
                    <label for="pleaded_guilty">Pleaded Guilty?</label>
                    <select id="pleaded_guilty" name="pleaded_guilty" required>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="reg_number">Registration Number</label>
                    <input type="text" id="reg_number" name="reg_number" required>
                </div>

                <div class="input-group">
                    <label for="inmate_image">Inmate Image</label>
                    <input type="file" id="inmate_image" name="inmate_image" accept="image/*" required>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" name="submit">Add Inmate</button>
            </div>
        </form>
    </div>
</body>
</html>
