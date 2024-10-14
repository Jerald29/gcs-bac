<?php
require '../../includes/session.php'; 
require '../../includes/conn.php'; // Include database connection

// Query to count all scheduled appointments
$sql = "SELECT COUNT(*) as total_schedules FROM tbl_schedules";
$result = $conn->query($sql);
$total_schedules = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_schedules = $row['total_schedules'];
}

// Query to count all pending schedules
$sql_pending = "SELECT COUNT(*) as total_pending FROM tbl_schedules WHERE status = 'pending'";
$result_pending = $conn->query($sql_pending);
$total_pending = 0;

if ($result_pending->num_rows > 0) {
    $row_pending = $result_pending->fetch_assoc();
    $total_pending = $row_pending['total_pending'];
}

// Query to count all students
$sql_students = "SELECT COUNT(*) as total_students FROM tbl_students";
$result_students = $conn->query($sql_students);
$total_students = 0;

if ($result_students->num_rows > 0) {
    $row_students = $result_students->fetch_assoc();
    $total_students = $row_students['total_students'];
}

// Query to count all confirmed schedules
$sql_confirmed = "SELECT COUNT(*) as total_confirmed FROM tbl_schedules WHERE status = 'confirmed'";
$result_confirmed = $conn->query($sql_confirmed);
$total_confirmed = 0;

if ($result_confirmed->num_rows > 0) {
    $row_confirmed = $result_confirmed->fetch_assoc();
    $total_confirmed = $row_confirmed['total_confirmed'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | GCS Bacoor</title>
    <link rel="icon" href="../../docs/assets/img/logo.png">

    <?php include '../../includes/links.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include '../../includes/navbar.php' ?>
        <?php include '../../includes/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md">
                            <div class="row">
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger"> 
                                        <div class="inner">
                                            <p>View Calendar</p>
                                            <h3>📅</h3> 
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-calendar-alt"></i> 
                                        </div>
                                        <a href="../schedules/student.calendar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <p>Scheduled Appointments</p>
                                            <h3><?php echo $total_schedules; ?></h3> <!-- Display total schedules -->
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <a href="<?php echo $_SESSION['role'] == "Administrator" ? "../schedules/list.schedule.php" : "#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <p>Confirmed Schedules</p>
                                            <h3><?php echo $total_confirmed; ?></h3> <!-- Display total confirmed schedules -->
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                        <a href="<?php echo $_SESSION['role'] == "Administrator" ? "../schedules/list.schedule.php" : "#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <p>Pending Schedules</p>
                                            <h3><?php echo $total_pending; ?></h3> <!-- Display total pending schedules -->
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <a href="<?php echo $_SESSION['role'] == "Administrator" ? "../schedules/list.schedule.php" : "#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <p>Students</p>
                                            <h3><?php echo $total_students; ?></h3> <!-- Display total students -->
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <a href="<?php echo $_SESSION['role'] == "Administrator" ? "../student/list.students.php" : "#" ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
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
