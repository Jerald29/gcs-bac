<?php
require '../../includes/session.php'; // Include session handling
require '../../includes/conn.php'; // Include database connection

// Ensure the user is a student
if ($_SESSION['role'] != 'Student') {
    $_SESSION['error'] = "Unauthorized access.";
    header('location: ../../login.php');
    exit();
}

// Get student ID from the session
$student_id = $_SESSION['id'];

// Fetch the scheduled appointments for the logged-in student, ordered by date and time
$schedule_info = $conn->prepare("SELECT * FROM tbl_schedules WHERE student_id = ? ORDER BY appointment_date ASC, appointment_time ASC");
$schedule_info->bind_param("i", $student_id);
$schedule_info->execute();
$result = $schedule_info->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Scheduled Appointments | GCS Bacoor</title>

    <?php include '../../includes/links.php'; // Bootstrap and other CSS files ?>
</head>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include '../../includes/navbar.php'; ?>
        <?php include '../../includes/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">My Scheduled Appointments</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">My Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Scheduled Appointments</h3>
                    </div>
                    <div class="card-body">

                        <!-- Display success or error messages -->
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($schedule = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($schedule['appointment_date']); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['appointment_time']); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['purpose']); ?></td>
                                            <td>
                                                <span class="badge <?php echo $schedule['status'] == 'confirmed' ? 'bg-success' : 'bg-warning'; ?>">
                                                    <?php echo ucfirst($schedule['status']); ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php if ($schedule['status'] !== 'confirmed'): ?>
                                                        <a href="edit.schedule.php?schedule_id=<?php echo $schedule['schedule_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <?php else: ?>
                                                        <button class="btn btn-secondary btn-sm" disabled>Edit</button>
                                                    <?php endif; ?>

                                                    <!-- Delete button with modal -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-<?php echo $schedule['schedule_id']; ?>">Delete</button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal for delete confirmation -->
                                        <div class="modal fade" id="modal-delete-<?php echo $schedule['schedule_id']; ?>">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-danger"><b>Delete Schedule</b></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete the schedule for <b><?php echo strtoupper($schedule['purpose']); ?></b> on <b><?php echo $schedule['appointment_date']; ?></b> at <b><?php echo $schedule['appointment_time']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a href="userData/ctrl.del.list.my.schedule.php?schedule_id=<?php echo $schedule['schedule_id']; ?>" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of modal -->
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No scheduled appointments found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include '../../includes/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include '../../includes/script.php'; ?>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>
