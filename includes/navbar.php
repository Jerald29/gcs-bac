<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center" style="background-color: rgba(255, 255, 255, 0); position: relative; height: 100vh;">
    <img class="animation__wobble" src="../../docs/assets/img/logo2.jpg" alt="GCS Bacoor" height="100" width="100">
    
    <!-- Loading bar -->
    <div class="loading-bar-container" style="position: absolute; bottom: 10%; width: 50%;">
        <div class="loading-bar" style="width: 100%; height: 6px; background-color: #ccc; border-radius: 3px; overflow: hidden;">
            <div class="loading-bar-fill" style="width: 0%; height: 100%; background-color: #ff0000; animation: load 2s infinite;"></div>
        </div>
    </div>
</div>

<!-- CSS for the loading bar animation -->
<style>
@keyframes load {
    0% {
        width: 0%;
    }
    50% {
        width: 70%;
    }
    100% {
        width: 100%;
    }
}
</style>


<!-- Navigation bar -->
<nav class="main-header navbar navbar-expand navbar-teal navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navigation bar links -->
    <?php
    // Ensure the database connection is established
    require '../../includes/conn.php'; // Include the database connection file

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Check if session variables are set before running queries
    if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
        // Query based on the user's role
        if ($_SESSION['role'] == "Super Administrator") {
            $sa_info = mysqli_query($conn, "SELECT * FROM tbl_master_key WHERE mk_id = '{$_SESSION['id']}'");
        } elseif ($_SESSION['role'] == "Administrator") {
            $admin_info = mysqli_query($conn, "SELECT * FROM tbl_admins WHERE admin_id = '{$_SESSION['id']}'");
        } elseif ($_SESSION['role'] == "Student") {
            $student_info = mysqli_query($conn, "SELECT * FROM tbl_students WHERE student_id = '{$_SESSION['id']}'");
        } elseif ($_SESSION['role'] == "Guest") {
            $guest_info = mysqli_query($conn, "SELECT * FROM tbl_guests WHERE guest_id = '{$_SESSION['id']}'");
        }

        // Fetch the query result if the query was successful
        if (isset($sa_info) || isset($admin_info) || isset($student_info) || isset($guest_info)) {
            $row = mysqli_fetch_array($sa_info ?? $admin_info ?? $student_info ?? $guest_info);

            if (!$row) {
                echo "Error fetching data: " . mysqli_error($conn);
            }
        } else {
            echo "No valid role found.";
        }
    } else {
        echo "Session variables not set.";
    }
    ?>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img style="width: 30px; height: 30px;" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>" class="user-image img-circle img-size-32">
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <div class="dropdown-item">
                    <div class="media">
                        <?php
                        if (!empty($row['img'])) {
                        ?>
                        <img style="width: 50px; height: 50px;" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <?php
                        } else {
                        ?>
                        <img style="width: 50px; height: 50px;" src="../../docs/assets/img/user2.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <?php
                        }
                        ?>
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            <b>
                                <?php echo $_SESSION['name']; ?>
                            </b>
                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm"><?php echo $row['email']?></p>
                        <p class="text-sm text-muted"><i class="far fa-user mr-1"></i><?php echo $row['username']?></p>
                    </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="../user/edit.account.php" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Edit Account
                </a>
                <div class="dropdown-divider"></div>
                <a href="../login/userData/ctrl.logout.php" class="dropdown-item dropdown-footer"><b>Log Out</b></a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
