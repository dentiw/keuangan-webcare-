<?php
// Start session to store the projects data
session_start();

// Initialize projects data if it's not already set
if (!isset($_SESSION['projects'])) {
    $_SESSION['projects'] = [];
}

// Handle Add New Project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    // Set the project number dynamically based on the number of existing projects
    $new_project_no = count($_SESSION['projects']) + 1;
    
    $new_project = [
        'no' => $new_project_no,
        'date' => $_POST['date'],
        'type' => $_POST['type'],
        'client' => $_POST['client']
    ];
    
    $_SESSION['projects'][] = $new_project;
}

// Handle Edit Project
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_project'])) {
    $no = $_POST['no'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $client = $_POST['client'];
    
    foreach ($_SESSION['projects'] as $key => &$project) {
        if ($project['no'] == $no) {
            $project['date'] = $date; // Update the date
            $project['type'] = $type; // Update the type
            $project['client'] = $client; // Update the client name
            break;
        }
    }
}

// Handle Delete Project
if (isset($_GET['delete'])) {
    $no = $_GET['delete'];
    foreach ($_SESSION['projects'] as $key => $project) {
        if ($project['no'] == $no) {
            unset($_SESSION['projects'][$key]);
            break;
        }
    }
    // Reindex array to prevent gaps in the project numbers
    $_SESSION['projects'] = array_values($_SESSION['projects']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Portal - Financial Statements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
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
        .sidebar img { width: 80%; margin-bottom: 20px; }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar a img { width: 20px; margin-right: 10px; }
        .sidebar a:hover { background-color: #0c47a1; }
        .content { margin-left: 270px; padding: 20px; }
        .table-container { margin-top: 20px; }
        .table thead { background-color: #1a73e8; color: white; }
        .btn { margin-top: 10px; }
        .btn-add-data { position: absolute; bottom: 20px; right: 20px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <img src="assets/img/Group 1.png" alt="Client Portal Logo">
        <a href="index.php"><img src="assets/img/dashboard.png" alt="Dashboard Icon">Dashboard</a>
        <a href="#"><img src="assets/img/vidio.png" alt="Video Icon">Video Tutorial</a>
        <a href="#"><img src="assets/img/user.png" alt="User Icon">User</a>
        <a href="#"><img src="assets/img/user-1.png" alt="User Icon">User</a>
        <a href="financial_statements.php"><img src="assets/img/gbr2.png" alt="Financial Icon">Financial Statements</a>
    </div>

    <div class="content">
        <a href="financial_statements.php"><img src="assets/img/gbr1.png" alt="Dashboard Icon">Laporan Keuangan</a>
        <div class="table-container">
            <h3>Expense</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Client</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['projects'])): ?>
                        <tr>
                            <td colspan="5" class="text-center">No projects found. Add a new project.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($_SESSION['projects'] as $project): ?>
                            <tr>
                                <td><?php echo $project['no']; ?></td>
                                <td><?php echo $project['date']; ?></td>
                                <td><?php echo $project['type']; ?></td>
                                <td><?php echo $project['client']; ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                            data-no="<?php echo $project['no']; ?>" data-date="<?php echo $project['date']; ?>"
                                            data-type="<?php echo $project['type']; ?>" data-client="<?php echo $project['client']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <a href="?delete=<?php echo $project['no']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <button class="btn btn-primary btn-add-data" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Add Data
        </button>
    </div>

    <!-- Modal Add Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel"><i class="fas fa-plus"></i> Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="date" class="form-label">Project Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Project Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="client" name="client" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_project">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="project_no" name="no">
                        <div class="mb-3">
                            <label for="edit_date" class="form-label">Project Date</label>
                            <input type="date" class="form-control" id="edit_date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type" class="form-label">Project Type</label>
                            <input type="text" class="form-control" id="edit_type" name="type" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_client" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="edit_client" name="client" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="edit_project">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set values for Edit modal
        var editModal = document.getElementById('editModal')
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var no = button.getAttribute('data-no')
            var date = button.getAttribute('data-date')
            var type = button.getAttribute('data-type')
            var client = button.getAttribute('data-client')

            var modalNo = editModal.querySelector('#project_no')
            var modalDate = editModal.querySelector('#edit_date')
            var modalType = editModal.querySelector('#edit_type')
            var modalClient = editModal.querySelector('#edit_client')

            modalNo.value = no
            modalDate.value = date
            modalType.value = type
            modalClient.value = client
        })
    </script>
</body>
</html>
