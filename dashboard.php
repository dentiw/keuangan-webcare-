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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
            margin-bottom: 10px;
            border-radius: 5px;
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
        .info-card {
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
        }
        .info-card h5 {
            font-size: 18px;
            color: #333;
        }
        .info-card p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
        }
        .recent-section {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .recent-section h6 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .recent-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .recent-item:last-child {
            border-bottom: none;
        }
        .icon-blue {
            fill: #1a73e8;
            width: 40px;
            height: 40px;
        }
        .logout-icon {
            margin-right: 10px; /* Move the icon to the left of the text */
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="assets/img/Group 1.png" alt="Client Portal Logo">
        <a href="#">
            <img src="assets/img/dashboard.png" alt="Dashboard Icon"> Dashboard
        </a>
        <a href="#">
            <img src="assets/img/user.png" alt="Client Icon"> Client
        </a>
        <a href="#">
            <img src="assets/img/vidio.png" alt="Video Icon"> Video Tutorial
        </a>
        <a href="#">
            <img src="assets/img/user.png" alt="User Icon"> User
        </a>
        <!-- Updated Log Out link with redirection to login.php -->
        <a href="login.php">
            <svg xmlns="http://www.w3.org/2000/svg" class="logout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Log Out
        </a>
    </div>

    <div class="content">
        <h2>Dashboard</h2>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="info-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M5.5 21h13c-1.6-4-11.4-4-13 0z"></path>
                    </svg>
                    <h5>Clients</h5>
                    <p>1</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <path d="M3 9h18"></path>
                        <path d="M9 21V9"></path>
                    </svg>
                    <h5>Projects</h5>
                    <p><?php echo $total_projects; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M5.5 21h13c-1.6-4-11.4-4-13 0z"></path>
                    </svg>
                    <h5>Admins</h5>
                    <p>1</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="recent-section">
                    <h6>Recent Clients</h6>
                    <div class="recent-item">
                        <span>Akmal Aditya</span>
                        <span>8 months ago</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="recent-section">
                    <h6>Recent Comments</h6>
                    <div class="recent-item">
                        <span>No comments yet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
