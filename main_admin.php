<?php
include 'connection.php';
session_start();

if ($_SESSION['role'] != 'main_admin') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
    
// Fetch user details from the database
 $sql = "SELECT * FROM users WHERE username = '$username' AND role='main_admin'";
 $result = mysqli_query($conn, $sql);
 $main_admin = mysqli_fetch_assoc($result);





// Fetch offense counts from the database
$offense_query = "SELECT offense, COUNT(*) as count FROM inmate GROUP BY offense";
$offense_result = mysqli_query($conn, $offense_query);

// Initialize categories
$crime_categories = [
    "most" => [],
    "moderate" => [],
    "few" => []
];

// Process data into categories
while ($row = mysqli_fetch_assoc($offense_result)) {
    if ($row['count'] > 40) {
        $crime_categories["most"][] = ["name" => $row['offense'], "count" => $row['count']];
    } elseif ($row['count'] >= 15) {
        $crime_categories["moderate"][] = ["name" => $row['offense'], "count" => $row['count']];
    } else {
        $crime_categories["few"][] = ["name" => $row['offense'], "count" => $row['count']];
    }
}

// Convert PHP array to JSON for JavaScript
echo "<script>
    var crimeCategories = " . json_encode($crime_categories) . ";
</script>";

// Fetch total inmates
$inmateCountQuery = "SELECT COUNT(*) AS total_inmates FROM inmate";
$inmateCountResult = mysqli_query($conn, $inmateCountQuery);
$inmateCount = mysqli_fetch_assoc($inmateCountResult)['total_inmates'];

// Fetch total staff
$staffCountQuery = "SELECT COUNT(*) AS total_staff FROM staffmanagement";
$staffCountResult = mysqli_query($conn, $staffCountQuery);
$staffCount = mysqli_fetch_assoc($staffCountResult)['total_staff'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
    
    body,
    html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #1e1e2f;
        color: #ddd;
    }

    .dashboard-container {
        display: flex;
        height: 100vh;

    }

    .sidebar {
        width: 250px;
        background-color: #2c2c3e;
        padding: 20px;
        color: #ddd;
        display: flex;
        flex-direction: column;
        height: 900px;
        position:fixed;
        left:0;
        overflow:hidden;
        padding-right:2px;

    }

    .logo h2 {
        color: #f58a42;
        text-align: center;
    }

    .sidebar-nav a {
        color: #ddd;
        text-decoration: none;
        padding: 10px 20px;
        display: block;
        margin: 10px 0;
        background-color: #3c3c4e;
        border-radius: 8px;
    }

    .sidebar-nav a:hover {
        background-color: orangered;
    }

    .main-content {
        flex-grow: 1;
        padding: 20px;
        background-color: #262637;
        padding-left:350px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 20px;
    }

    .greeting {
        font-size: 1.5em;
    }

    .profile-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .stats {
        display: flex;
        gap: 20px;
        padding: 20px 0;
    }

    .stat-card {
        flex: 1;
        background-color: #3c3c4e;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        color: #f58a42;
    }

    .charts {
        display: flex;
        gap: 20px;
        padding: 20px 0;
    }

    .card {
        background-color: #3c3c4e;
        flex: 1;
        padding: 20px;
        border-radius: 8px;
    }

    .actions {
        padding: 20px 0;
        display: flex;
        gap: 20px;
    }

    .action-button {
        background-color: #f58a42;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1em;
    }

    .action-button:hover {
        background-color: #d4743c;
    }

    .icon {
        width: 45px;

        height: 45px;
        vertical-align: middle;
        margin-right: 8px;
    }

    .sidebar img {
        width: 45px;
        height: 45px;
        width: 45px;

        height: 45px;
        vertical-align: middle;
        margin-right: 8px;
    }
    </style>
    <link rel="stylesheet" href="pixels/openBox.css" type="text/css" />
</head>

<body>
    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="logo">
                <img src='images/logo.jpg' style="width:100px; height:100px; border-radius:20px;" />
            </div>
            <div class="spacer" style="height:20px"></div>
            <nav class="sidebar-nav">
                <a href="#">
                    <img src="icons/dash.png" alt="Cases Icon" class="nav-icon"> Dashboard
                </a>
                <div class="spacer" style='height:40px'></div>
                <a href="main_admin_profile.php">
                    <img src="icons/person.png" alt="Inmate Icon" class="nav-icon"> My Profile
                </a>
                <div class="spacer" style='height:40px'></div>

                <a href="assign_role.php">
                    <img src="icons/roles.png" alt="Staff Icon" class="nav-icon"> Assign Roles
                </a>
                <div class="spacer" style='height:40px'></div>
                <a href="main_admin_logs.php">
                    <img src="icons/logs.png" alt="Inmate Icon" class="nav-icon"> Logs
                </a>
                <div class="spacer" style='height:10px'></div>
                
                <a href="logout.php" onclick="return confirm('You are about to be signned-out, continue?')">
                    <img src="icons/logout.png" alt="Reports Icon" class="nav-icon"> Logout
                </a>
            </nav>

        </aside>

        <main class="main-content">
            <header class="header">
                <div class="greeting">
                    <p>Welcome Main Admin, <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?> !</p>
                </div>
                <div class="profile">
                    <img src="<?php echo $main_admin['main_admin_profile_picture'] && file_exists($main_admin['main_admin_profile_picture']) ? $main_admin['main_admin_profile_picture'] : 'icons/person.png'; ?>"
                        alt="Profile" class="profile-icon">
                </div>
            </header>

            <section class="stats">
                <div class="stat-card">
                    <h3>Total Inmates</h3>
                    <p><?php echo $inmateCount; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Staffs</h3>
                    <p><?php echo $staffCount; ?></p>
                </div>
                <a onclick=" return confirm('continue downloading report?')" style="display:block; text-decoration:none " href="gen_rep.php"><div class="stat-card"  style="height:85px">
                    <h3>Genereate Report</h3>
                   
                </div></a>
            </section>

            <section class="charts">
                <div class="chart card">
                    <h3>Case Analysis</h3>
                    <canvas id="casePieChart"></canvas>
                </div>
                <div class="chart card">
                    <h3>Case Trends</h3>
                    <canvas id="caseLineChart"></canvas>
                </div>
            </section>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById("casePieChart").getContext("2d");

        function getRandomColor() {
            const letters = "0123456789ABCDEF";
            let color = "#";
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        const labels = [];
        const data = [];
        const backgroundColors = [];

        ["most", "moderate", "few"].forEach(category => {
            const offenses = crimeCategories[category];
            offenses.forEach(offense => {
                labels.push(offense.name);
                data.push(offense.count);
                backgroundColors.push(getRandomColor());
            });
        });

        const casePieChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "top",
                        labels: {
                            color: "#ffffff"
                        }
                    },
                    title: {
                        display: true,
                        text: "Crime Distribution by Offense Category",
                        color: "#f58a42"
                    }
                }
            }
        });

        // Line chart for offenses over time
        const ctxLine = document.getElementById('caseLineChart').getContext('2d');

        // Prepare labels and data for the line chart
        const offenseLabels = [];
        const offenseCounts = [];

        // Gather data for the line chart
        Object.entries(crimeCategories).forEach(([category, offenses]) => {
            offenses.forEach(offense => {
                offenseLabels.push(offense.name);
                offenseCounts.push(offense.count);
            });
        });

        const caseLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: offenseLabels,
                datasets: [{
                    label: 'Offenses Over Time',
                    data: offenseCounts,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#444'
                        }
                    },
                    x: {
                        grid: {
                            color: '#444'
                        }
                    }
                }
            }
        });
    });




    function confirmAction() {

        window.location.href = "staffs.php";
    }

    function confirmLogout() {

        window.location.href = "logout.php";
    }
    </script>
    <script src="scripts/openBox.js"></script>

    <!-- Custom confirmation modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>You are about to sign out. Continue?</p>
            <button onclick="confirmAction()">Yes</button>
            <button onclick="closeConfirmBox()">No</button>
        </div>
    </div>

    </script>


</body>

</html>