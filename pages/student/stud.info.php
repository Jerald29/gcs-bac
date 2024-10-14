<?php
require '../../includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guidance Form | GCS Bacoor</title>

    <?php include '../../includes/links.php'; ?>

</head>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
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
                            <h1 class="m-0">Fill Up Guidance Form</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"></a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <form action="userData/ctrl.stud.info.php" method="POST">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Student's Profile</b></h3>
                                    </div>
                                    <div class="card-body">

                                    <div class="row mb-4">
                                    <div class="col-sm-12 mb-2">
                                        <h5><b>I. Personal Information</b></h5>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="lastname">Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <label for="firstname">First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-2">
                                        <label for="midname">Middle Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="midname" name="midname" placeholder="Middle name">
                                        </div>
                                    </div>
                                    </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-4 mb-2">
                                                <label for="campus">Campus</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="campus" name="campus" placeholder="Campus">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 mb-2">
                                                <label for="program">Program</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="program" name="program" placeholder="Program">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 mb-2">
                                                <label for="level">Level</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="level" name="level" placeholder="Level">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="address">Residential/Permanent Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Residential/Permanent Address">
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-4 mb-2">
                                                <label for="birthdate">Date of Birth</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Date of Birth">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 mb-2">
                                                <label for="birthplace">Place of Birth</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Place of Birth">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 mb-2">
                                                <label for="sex">Sex</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                    </div>
                                                    <select class="form-control" id="sex" name="sex">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-4 mb-2">
                                                <label for="civil_status">Civil Status</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-ring"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="civil_status" name="civil_status" placeholder="Civil Status">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 mb-2">
                                                <label for="citizenship">Citizenship</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Citizenship">
                                                </div>
                                            </div>

                                            <div class="col-sm-2 mb-2">
                                                <label for="height">Height</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="height" name="height" placeholder="Height">
                                                </div>
                                            </div>

                                            <div class="col-sm-2 mb-2">
                                                <label for="weight">Weight</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-3 mb-2">
                                                <label for="blood_type">Blood Type</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="blood_type" name="blood_type" placeholder="Blood Type">
                                                </div>
                                            </div>

                                            <div class="col-sm-3 mb-2">
                                                <label for="mobile_number">Mobile Number</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number">
                                                </div>
                                            </div>

                                            <div class="col-sm-3 mb-2">
                                                <label for="telephone_number">Telephone Number</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Telephone Number">
                                                </div>
                                            </div>

                                            <div class="col-sm-3 mb-2">
                                                <label for="email_address">Email Address</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="email_address" name="email_address" placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-12 mb-2">
                                                <h5><b>II. Family Background</b></h5>
                                            </div>
                                                <div class="col-sm-4 mb-2">
                                                    <label for="father's_name">Father's Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                        </div>
                                                    <input type="text" class="form-control" id="father's_name" name="father's_name"         placeholder="Father's Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include '../../includes/script.php'; ?>
</body>

</html>
