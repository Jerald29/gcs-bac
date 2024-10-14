<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-teal elevation-4" style="border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
  <!-- Brand Logo -->
  <a href="../dashboard/index.php" class="brand-link navbar-teal">
    <img src="../../docs/assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light text-light" style="font-family: 'Cambria', Times, serif; text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);"><b>GCS Bacoor</b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      <?php
                      if (!empty($row['img'])) {
                      ?>
                      <img style="width: 40px; height: 40px;" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>" class="img-circle elevation-2 mt-2" alt="User Image">
                      <?php
                      } else {
                      ?>
                      <img style="width: 40px; height: 40px;" src="../../docs/assets/img/user2.png" class="img-circle elevation-2 mt-2" alt="User Image">
                      <?php
                      }
                      ?>
      </div>
      <div class="info">
        <a class="d-block text-light"><?php echo $_SESSION['name']; ?></a>
        <p class="mb-0 text-light"><small><?php echo $_SESSION['role']; ?></small></p>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="../dashboard/index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php
          if ($_SESSION['role'] == "Super Administrator") { // Super Administrator sidebar
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              User Lists
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../super_admin/list.administrator.php" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Administrator List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>
              Add User
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../super_admin/add.administrator.php" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>Add Administrator</p>
              </a>
            </li>
          </ul>
        </li>
        <?php
          } elseif ($_SESSION['role'] == "Administrator") { //Admin sidebar
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              Manage Schedules
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../schedules/admin.add.schedule.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Add Schedule</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../schedules/list.schedule.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Confirm Schedules</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add Users
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../student/add.student.php" class="nav-link">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Student</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../guests/add.guest.php" class="nav-link">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Guest</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-address-book nav-icon"></i>
                <p>Users List
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../student/list.students.php" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Student</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../guests/list.guests.php" class="nav-link">
                    <i class="fas fa-list nav-icon"></i>
                    <p>Guest</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Forms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                  <a href="../forms/studentInfo.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                  <p>Student Information</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-folder nav-icon"></i>
                <p>Guidance Form
                <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../forms/form-1.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-4.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 4</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-6.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 6</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-7.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 7</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-8.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 8</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-9.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 9</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-10.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 10</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-12.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 12</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!--<?php
          //} elseif ($_SESSION['role'] == "Administrator") {
        ?>-->
        <?php
          } elseif ($_SESSION['role'] == "Student") {
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              Manage Schedule
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../schedules/add.schedule.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Add Schedule</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../schedules/list.my.schedule.php" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  My Schedule
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../schedules/student.calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Check All Schedules
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Fill up forms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="../fillup/stud.profile.php" class="nav-link">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Student's Profile</p>
                </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
              Forms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
                  <a href="../student/stud.info.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                  <p>Fill Up Guidance Form</p>
                </a>
            </li>
            <li class="nav-item">
                  <a href="../forms/studentInfo.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                  <p>Student Information</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-folder nav-icon"></i>
                <p>Guidance Form
                <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../forms/form-1.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-4.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 4</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-6.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 6</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-7.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 7</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-8.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 8</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-9.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 9</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-10.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 10</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../forms/form-12.php" class="nav-link">
                    <i class="fas fa-file nav-icon"></i>
                    <p>Form 12</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          } elseif ($_SESSION['role'] == "Guest") {
        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
              Manage Schedule
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../schedules/add.schedule.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Add Schedule</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../schedules/list.my.schedule.php" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  My Schedule
                </p>
              </a>
            </li>
          </ul>
        </li>
        <?php
          }
        ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
