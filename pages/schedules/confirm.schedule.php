<?php
require '../../includes/session.php';
require '../../includes/conn.php'; 

$message = ""; // Initialize the message variable

// Check if a schedule ID and action are provided via GET request
if (isset($_GET['schedule_id']) && isset($_GET['action'])) {
    $schedule_id = $_GET['schedule_id'];
    $action = $_GET['action'];

    // Prepare the SQL statement based on the action (confirm or unconfirm)
    if ($action == 'confirm') {
        $stmt = $conn->prepare("UPDATE tbl_schedules SET status = 'confirmed' WHERE schedule_id = ?");
        $message = "Schedule confirmed!";
    } elseif ($action == 'unconfirm') {
        $stmt = $conn->prepare("UPDATE tbl_schedules SET status = 'pending' WHERE schedule_id = ?");
        $message = "Schedule unconfirmed!";
    } else {
        $message = "Invalid action.";
    }

    // Execute the SQL if a valid action is provided
    if (isset($stmt)) {
        $stmt->bind_param("i", $schedule_id);

        if ($stmt->execute()) {
            // Message is already set above
        } else {
            $message = "Error updating schedule.";
        }

        $stmt->close();
    }

    $conn->close();
} else {
    $message = "No schedule ID or action provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm/Unconfirm Schedule | GCS Bacoor</title>

    <?php include '../../includes/links.php'; ?>
    
    <!-- Add SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
                            <h1 class="m-0">Confirm/Unconfirm Schedule</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Confirm/Unconfirm Schedule</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3 class="card-title">Confirmation Result</h3>
                                </div>
                                <div class="card-body text-center">
                                    <div id="confirmation-message">
                                        <?php if ($message): ?>
                                            <h4><?php echo $message; ?></h4>
                                        <?php else: ?>
                                            <h4>No result to display.</h4>
                                        <?php endif; ?>
                                    </div>
                                    <a href="list.schedule.php" class="btn btn-primary mt-3">Back to Schedule List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../../includes/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <?php include '../../includes/script.php'; ?>

    <script>
        const message = "<?php echo addslashes($message); ?>"; 
        if (message) {
            if (message.includes("Error")) {
                swal('Error!', message, 'error').then(function() {
                    window.location = 'list.schedule.php';
                });
            } else {
                swal('Success!', message, 'success').then(function() {
                    window.location = 'list.schedule.php';
                });
            }
        }
    </script>

</body>

</html>
