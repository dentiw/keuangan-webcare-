<?php
// Mulai session
session_start();

// Contoh data (seharusnya diambil dari database atau session)
if (!isset($_SESSION['projects'])) {
    $_SESSION['projects'] = [
        ['no' => 1, 'date' => '2024-01-01', 'type' => 'Construction', 'client' => 'Client A'],
        ['no' => 2, 'date' => '2024-02-01', 'type' => 'Design', 'client' => 'Client B'],
        // Tambahkan proyek lain sesuai kebutuhan
    ];
}

$total_projects = count($_SESSION['projects']); // Menghitung total proyek

// Contoh pendapatan dan pengeluaran (seharusnya diambil dari database atau session)
$income = 100000000;  // Contoh pendapatan
$expense = 5000000;   // Contoh pengeluaran

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Statements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #1a73e8;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 10px;
            text-align: center;
        }
        .sidebar img {
            width: 80%;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar a img {
            width: 20px;
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #0c47a1;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .info-box img {
            width: 40px;
            margin-right: 15px;
        }
        .info-box h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .info-box p {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0 0;
        }
        .icon-box {
            background-color: #1a73e8;
            border-radius: 8px;
            padding: 15px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .icon-box img {
            width: 40px;
            height: 40px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="assets/img/Group 1.png" alt="Client Portal Logo">
        <a href="dashboard.php"><img src="assets/img/dashboard.png" alt="Dashboard Icon">Dashboard</a>
        <a href="video_tutorial.php"><img src="assets/img/vidio.png" alt="Video Icon">Video Tutorial</a>
        <a href="user_profile.php"><img src="assets/img/user.png" alt="User Icon">User</a>
        <a href="user_settings.php"><img src="assets/img/user-1.png" alt="User Icon">User Settings</a>
        <a href="financial_statements.php"><img src="assets/img/gbr2.png" alt="Financial Icon">Financial Statements</a>
    </div>

    <div class="content">
        <a href="financial_statements.php"><img src="assets/img/gbr1.png" alt="Financial Icon">Financial Statements</a>
        
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <a href="total_projects.php"> <!-- Link to Total Projects Page -->
                        <div class="icon-box">
                            <img src="assets/img/icon1.png" alt="Project Icon">
                        </div>
                        <div>
                            <h4>Total Projects</h4>
                            <p><?php echo $total_projects; ?>+</p> <!-- Dinamis dari PHP -->
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <a href="income.php"> <!-- Link to Income Page -->
                        <div class="icon-box">
                            <img src="assets/img/icon2.png" alt="Income Icon">
                        </div>
                        <div>
                            <h4>Income</h4>
                            <p>Rp. <?php echo number_format($income, 0, ',', '.'); ?></p> <!-- Dinamis dari PHP -->
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <a href="expense.php"> <!-- Link to Expense Page -->
                        <div class="icon-box">
                            <img src="assets/img/icon3.png" alt="Expense Icon">
                        </div>
                        <div>
                            <h4>Expense</h4>
                            <p>Rp. <?php echo number_format($expense, 0, ',', '.'); ?></p> <!-- Dinamis dari PHP -->
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Graphs below each other -->
        <div class="row">
            <div class="col-md-12">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <canvas id="comparisonChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const incomeChart = new Chart(document.getElementById('incomeChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Income Statistic in 2024',
                    data: [100, 200, 300, 400, 500, 600, 700, 800, 900, 800, 600, 400],
                    borderColor: '#1a73e8',
                    backgroundColor: 'rgba(26, 115, 232, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
            }
        });

        const comparisonChart = new Chart(document.getElementById('comparisonChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Income',
                        data: [100, 150, 200, 250, 300, 400, 500, 550, 600, 700, 800, 850],
                        backgroundColor: '#1a73e8',
                    },
                    {
                        label: 'Expense',
                        data: [50, 80, 120, 150, 180, 200, 220, 240, 260, 300, 320, 350],
                        backgroundColor: '#ff5252',
                    }
                ]
            },
            options: {
                responsive: true,
            }
        });
    </script>
</body>
</html>
