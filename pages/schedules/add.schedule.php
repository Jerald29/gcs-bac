<?php
require '../../includes/session.php'; // Include session management
require '../../includes/conn.php'; // Include database connection

// Ensure the user is a student
if ($_SESSION['role'] != 'Student') {
    $_SESSION['error'] = "Unauthorized access.";
    header('location: ../../login.php');
    exit();
}

// Get student details from the session
$student_id = $_SESSION['id']; 
$student_lname = $_SESSION['name']; // Assuming session stores student lname, fname together

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $purpose = $_POST['purpose'];

    // Check for existing schedules for the student on the selected date
    $existingCheck = $conn->prepare("SELECT * FROM tbl_schedules WHERE student_id = ? AND appointment_date = ?");
    $existingCheck->bind_param("is", $student_id, $date);
    $existingCheck->execute();
    $existingResult = $existingCheck->get_result();

    if ($existingResult->num_rows > 0) {
        $_SESSION['error'] = "You can only add one schedule per day.";
    } else {
        // Check for scheduling conflicts (time slots)
        $conflictCheck = $conn->prepare("SELECT * FROM tbl_schedules WHERE appointment_date = ? AND appointment_time = ?");
        $conflictCheck->bind_param("ss", $date, $time);
        $conflictCheck->execute();
        $result = $conflictCheck->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Conflict: The selected time slot is already booked.";
        } else {
            // Prepare the SQL statement to insert a new schedule
            $stmt = $conn->prepare("INSERT INTO tbl_schedules (student_id, appointment_date, appointment_time, purpose, status) VALUES (?, ?, ?, ?, 'pending')");
            $stmt->bind_param("isss", $student_id, $date, $time, $purpose);

            // Check if the execution is successful
            if ($stmt->execute()) {
                $_SESSION['success'] = "Schedule added successfully!";
            } else {
                $_SESSION['error'] = "Error adding schedule: " . $stmt->error;
            }

            $stmt->close();
        }

        $conflictCheck->close();
    }

    $existingCheck->close();

    // Redirect to the same page to display success/error message
    header('location: ../schedules/add.schedule.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Schedule | GCS Bacoor</title>

    <?php include '../../includes/links.php'; ?>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
                            <h1 class="m-0">Add Schedule</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Schedule</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <?php
            // Display success or error messages
            if (isset($_SESSION['success'])) {
                echo "<script>
                        swal('Success!', '{$_SESSION['success']}', 'success').then(function() {
                            window.location = '../schedules/add.schedule.php';
                        });
                      </script>";
                unset($_SESSION['success']);
            } elseif (isset($_SESSION['error'])) {
                echo "<script>
                        swal('Error!', '{$_SESSION['error']}', 'error').then(function() {
                            window.location = '../schedules/add.schedule.php';
                        });
                      </script>";
                unset($_SESSION['error']);
            }
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Schedule Info</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="" id="scheduleForm">
                                        <div class="form-group mb-4">
                                            <label for="student_name">Student</label>
                                            <input type="text" name="student_name" class="form-control" value="<?php echo $student_lname; ?>" readonly>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" class="form-control" id="date" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="time">Time</label>
                                            <select id="time" name="time" class="form-control" required>
                                                <option value="">Select Time</option>
                                                <option value="08:00">8:00 AM</option>
                                                <option value="09:00">9:00 AM</option>
                                                <option value="10:00">10:00 AM</option>
                                                <option value="11:00">11:00 AM</option>
                                                <option value="12:00">12:00 PM</option>
                                                <option value="13:00">1:00 PM</option>
                                                <option value="14:00">2:00 PM</option>
                                                <option value="15:00">3:00 PM</option>
                                                <option value="16:00">4:00 PM</option>
                                                <option value="17:00">5:00 PM</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="purpose">Purpose</label>
                                            <input type="text" name="purpose" class="form-control" id="purpose" required>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-danger">Add Schedule</button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
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
