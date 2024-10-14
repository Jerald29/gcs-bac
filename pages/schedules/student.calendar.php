<?php
require '../../includes/session.php'; // Include session handling
require '../../includes/conn.php'; // Include database connection

// Ensure the user is a student
if ($_SESSION['role'] != 'Student') {
    header('Location: ../dashboard/index.php');
    exit();
}

// Get selected year and month from POST request, default to current year and month
$selectedYear = isset($_POST['year']) ? intval($_POST['year']) : date('Y');
$selectedMonth = isset($_POST['month']) ? intval($_POST['month']) : date('n');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Calendar | GCS Bacoor</title>

    <?php include '../../includes/links.php'; ?>
    <style>
        /* Calendar styles */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .day {
            border: 1px solid #dee2e6;
            padding: 10px;
            background-color: #f8f9fa;
            height: 150px; /* Fixed height for uniformity */
            position: relative;
            overflow-y: auto; /* Enable vertical scrolling if content exceeds the height */
        }
        .day h5 {
            margin: 0;
            font-size: 1.2em;
        }
        .appointment {
            background-color: #007bff;
            color: #fff;
            padding: 5px;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden; /* Ensure text doesn't overflow */
            text-overflow: ellipsis; /* Add ellipsis for long text */
            white-space: nowrap; /* Prevent text wrapping */
        }
        .empty {
            background-color: #e9ecef;
        }
    </style>
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
                            <h1 class="m-0">Check Schedules (All Students)</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Check Schedules</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <!-- Year and Month Dropdown -->
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="year">Select Year:</label>
                                <select name="year" id="year" class="form-control">
                                    <?php
                                    // Display a range of years (e.g., from 2020 to the current year)
                                    for ($i = 2020; $i <= date('Y') + 1; $i++) {
                                        echo '<option value="' . $i . '"' . ($i == $selectedYear ? ' selected' : '') . '>' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="month">Select Month:</label>
                                <select name="month" id="month" class="form-control">
                                    <?php
                                    // Display months
                                    for ($m = 1; $m <= 12; $m++) {
                                        echo '<option value="' . $m . '"' . ($m == $selectedMonth ? ' selected' : '') . '>' . DateTime::createFromFormat('!m', $m)->format('F') . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">View Schedule</button>
                        </form>

                        <div class="calendar">
                            <?php
                            // Fetch all appointments for the selected month and year
                            $sql = "SELECT appointment_date, appointment_time FROM tbl_schedules WHERE status IN ('confirmed', 'pending') AND YEAR(appointment_date) = $selectedYear AND MONTH(appointment_date) = $selectedMonth";
                            $result = $conn->query($sql);

                            // Prepare an array to hold appointments by date
                            $appointments = [];
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Store each appointment time in an array grouped by the date
                                    $appointments[$row['appointment_date']][] = $row['appointment_time'];
                                }
                            }

                            // Sort appointments by time for each day
                            foreach ($appointments as &$times) {
                                sort($times); // Sort times in ascending order
                            }

                            // Get the number of days in the selected month
                            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
                            $firstDayOfMonth = new DateTime("$selectedYear-$selectedMonth-01");

                            // Fill in the calendar for the selected month
                            for ($day = 1; $day <= $daysInMonth; $day++) {
                                $currentDay = new DateTime("$selectedYear-$selectedMonth-$day");
                                $dateStr = $currentDay->format('Y-m-d');
                                echo '<div class="day' . (!isset($appointments[$dateStr]) ? ' empty' : '') . '">';
                                echo '<h5>' . $currentDay->format('d M') . '</h5>';
                                
                                // Display appointments for the current date
                                if (isset($appointments[$dateStr])) {
                                    foreach ($appointments[$dateStr] as $time) {
                                        echo '<div class="appointment">' . htmlspecialchars($time) . '</div>';
                                    }
                                }

                                echo '</div>';
                            }
                            ?>
                        </div>
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
