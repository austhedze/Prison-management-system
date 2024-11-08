<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $staff_first_name = $_POST['staff_first_name'];

    // Handle the image upload
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image type
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "<script>alert('File is not an image.');</script>";
        $upload_ok = 0;
    }

    // Check file size (5MB max)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "<script>alert('File is too large.');</script>";
        $upload_ok = 0;
    }

    // Allow only certain formats
    if (!in_array($image_file_type, ["jpg", "png", "jpeg", "gif", "webm", "jfif"])) {
        echo "<script>alert('Only jfif, WEBM, JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $upload_ok = 0;
    }

    // Check if upload is ok

    if ($upload_ok && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
        // Insert into database with image path
        $sql = "INSERT INTO staffManagement (staff_first_name, last_name, role, age, gender, phone, email, hire_date, image_path) 
                VALUES ('$staff_first_name', '$last_name', '$role', '$age', '$gender', '$phone', '$email', '$hire_date', '$target_file')";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script>
                alert("Staff member added successfully!");
                window.location.href="admin.php";
            </script>';
        } else {
            die(mysqli_error($conn));
        }
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff Member</title>
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

            <h2>Add Staff Member</h2>

            <div class="form-grid">
                <div class="input-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="staff_first_name" required>
                </div>

                <div class="input-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>

                <div class="input-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="Admin">Admin</option>
                        <option value="Main Admin">Main Admin</option>
                        <option value="Visitation Manager">Visitation Manager</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" required>
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                     
                    </select>
                </div>

                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="hire_date">Hire Date</label>
                    <input type="date" id="hire_date" name="hire_date" required>
                </div>
            </div>
            <div class="input-group">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <div class="button-group">
                <button type="submit" name="submit">Add Staff Member</button>
            </div>
        </form>
    </div>
</body>

</html>