<?php
require '../../includes/session.php'; // Include session handling
require '../../includes/conn.php'; // Include database connection

// Ensure the user is logged in
if (!isset($_SESSION['logged_in'])) {
    header('location: ../../login.php');
    exit();
}

// Determine the user's role and get their details
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role == 'Student') {
    // Fetch student details
    $sql = "SELECT student_id, student_fname, student_mname, student_lname, email FROM tbl_students WHERE student_id = ?";
} elseif ($role == 'Administrator') {
    // Fetch administrator details
    $sql = "SELECT admin_id, admin_fname, admin_mname, admin_lname, email FROM tbl_admins WHERE admin_id = ?";
} else {
    $_SESSION['error'] = "Unauthorized access.";
    header('location: ../../login.php');
    exit();
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    if ($role == 'Student') {
        // Update student account
        $update_sql = "UPDATE tbl_students SET student_fname = ?, student_mname = ?, student_lname = ?, email = ? WHERE student_id = ?";
    } else {
        // Update admin account
        $update_sql = "UPDATE tbl_admins SET admin_fname = ?, admin_mname = ?, admin_lname = ?, email = ? WHERE admin_id = ?";
    }

    $stmt_update = $conn->prepare($update_sql);
    if ($role == 'Student') {
        $stmt_update->bind_param("ssssi", $fname, $mname, $lname, $email, $user_id);
    } else {
        $stmt_update->bind_param("ssssi", $fname, $mname, $lname, $email, $user_id);
    }

    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Account updated successfully!";
        header('location: index.php'); // Redirect after successful update
        exit();
    } else {
        $_SESSION['error'] = "Failed to update account: " . $stmt_update->error;
    }
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Account | GCS Bacoor</title>
    <link rel="icon" href="../../docs/assets/img/logo.png">

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
                            <h1 class="m-0">Edit Account</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Account</li>
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
                            window.location = 'edit.account.php';
                        });
                      </script>";
                unset($_SESSION['success']);
            } elseif (isset($_SESSION['error'])) {
                echo "<script>
                        swal('Error!', '{$_SESSION['error']}', 'error').then(function() {
                            window.location = 'edit.account.php';
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
                                    <h3 class="card-title">Account Info</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="" id="accountForm">
                                        <div class="form-group mb-4">
                                            <label for="fname">First Name</label>
                                            <input type="text" name="fname" class="form-control" value="<?php echo $role == 'Student' ? $user['student_fname'] : $user['admin_fname']; ?>" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="mname">Middle Name</label>
                                            <input type="text" name="mname" class="form-control" value="<?php echo $role == 'Student' ? $user['student_mname'] : $user['admin_mname']; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="lname">Last Name</label>
                                            <input type="text" name="lname" class="form-control" value="<?php echo $role == 'Student' ? $user['student_lname'] : $user['admin_lname']; ?>" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-danger">Update Account</button>
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

<?php
$conn->close(); // Close the database connection
?>
