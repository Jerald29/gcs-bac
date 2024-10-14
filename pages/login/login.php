<?php
require '../../includes/conn.php';
ob_start();
session_start();

if (isset($_SESSION['role'])) {
    header("location: pages/dashboard/index.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In | Guidance Counseling System</title>
  <link rel="icon" href="../../docs/assets/img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  
  <!-- CSS for form size and animation -->
  <style>
    /* Slightly reduce the size of the login-box and its content */
    .login-box {
      width: 350px; /* Reduce the width to make the form smaller */
    }

    .card {
      padding: 0px; /* Add a bit more padding to keep proportions comfortable */
    }

    .password-toggle {
      cursor: pointer;
      position: relative;
      transition: opacity 0.3s ease, transform 0.1s ease; /* Smooth transition for the icon */
    }

    .password-toggle:hover {
      opacity: 0.7; /* Changes opacity when hovering to give a smoother feel */
    }

    .input-group .form-control {
      transition: border-color 0.3s ease; /* Optional: Smooth transition for border color */
    }

    /* Container to hold the icon animation effect */
    .icon-wrapper {
      display: inline-block;
      position: relative;
    }

    .fa-eye {
      transition: transform 0.1s ease; /* Smooth transition for eye following cursor */
    }

    /* Center the academic image */
    .centered-image {
      display: block;
      margin: 20px auto 0 auto; /* Adjust margin as needed */
      max-width: 60%;
      margin-left: 66.5px;
      height: auto;
    }
  </style>
  
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-teal">
    <div class="card-header bg-teal text-center" style="font-family: 'Cambria', serif;"> <!-- Set the font family here -->
        <a href="https://stfrancisbacoor.com" target="_blank"> <!-- Link wraps the logo -->
            <img class="mb-2" height="50" width="50" src="../../docs/assets/img/logo.png" alt="logo-signin"> <!-- Make logo slightly smaller -->
        </a>
        <h4><b>Saint Francis of Assisi College - Bacoor</b></h4> <!-- Reduced font size -->
        <h6><b>Guidance Counseling System</b></h6> <!-- Reduced font size -->
    </div>
    <div class="card-body">
      <p class="login-box-msg" style="font-family: 'Cambria', serif;">Sign in to your account.</p>
      <form action="userData/ctrl.login.php" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text icon-wrapper password-toggle" onmousemove="eyeFollow(event)" onclick="togglePassword()">
              <span class="fas fa-eye" id="toggleIcon"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center"> <!-- Center the button -->
            <button type="submit" name="submit" class="btn btn-outline-teal" style="background-color: #00C0A3; color: white;">Sign In</button>
          </div>
        </div>
        <!-- Add the image below the sign-in button -->
        <div class="row">
          <div class="col-12 text-center">
            <img src="../../docs/assets/img/acads.png" alt="Academics" class="centered-image"> <!-- Use the centered-image class -->
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

<!-- JavaScript for toggling password visibility -->
<script>
  function togglePassword() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    // Toggle between password and text
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  }

  function eyeFollow(event) {
    const toggleIcon = document.getElementById('toggleIcon');
    const iconRect = toggleIcon.getBoundingClientRect();

    // Calculate the center of the eye icon
    const centerX = iconRect.left + (iconRect.width / 2);
    const centerY = iconRect.top + (iconRect.height / 2);

    // Calculate the angle between the cursor and the center of the icon
    const angle = Math.atan2(event.clientY - centerY, event.clientX - centerX);

    // Move the eye icon in the direction of the cursor
    const xOffset = Math.cos(angle) * 5; // Control movement by reducing magnitude
    const yOffset = Math.sin(angle) * 5;

    // Apply the movement to the icon using a transform
    toggleIcon.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
  }
</script>

<?php
if (isset($_SESSION['password_incorrect'])) {
  echo "<script>
    $(function() {
      toastr.error('Password is incorrect.','Error')
    });
    </script>";
} elseif (isset($_SESSION['username_incorrect'])) {
  echo "<script>
    $(function() {
      toastr.error('Username is incorrect.','Error')
    });
    </script>";
}
session_destroy();
?>

</body>
</html>
