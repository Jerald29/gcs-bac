<?php
require '../../../includes/session.php';
require '../../../includes/conn.php'; // Ensure database connection

$admin_id = $_GET['admin_id'];

// Initialize session variables for feedback
$_SESSION['no_image'] = $_SESSION['no_image'] ?? false;
$_SESSION['no_pass'] = $_SESSION['no_pass'] ?? false;
$_SESSION['password_unmatch'] = $_SESSION['password_unmatch'] ?? false;
$_SESSION['success'] = $_SESSION['success'] ?? false;

// Check if the upload button was clicked
if (isset($_POST['upload'])) {
    if (empty($_FILES['image']['tmp_name'])) {
        $_SESSION['no_image'] = true;
        header('location: ../edit.administrator.php?admin_id=' . $admin_id);
        exit();
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $set_userInfo = mysqli_query($conn, "UPDATE tbl_admins SET img = '$image' WHERE admin_id = '$admin_id'");
        
        if ($set_userInfo) {
            $_SESSION['success'] = true;
        } else {
            // Handle failure to update image
            $_SESSION['update_failed'] = true;
        }
        header('location: ../edit.administrator.php?admin_id=' . $admin_id);
        exit();
    }
} elseif (isset($_POST['submit'])) {
    $admin_fname = mysqli_real_escape_string($conn, $_POST['admin_fname']);
    $admin_mname = mysqli_real_escape_string($conn, $_POST['admin_mname']);
    $admin_lname = mysqli_real_escape_string($conn, $_POST['admin_lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    // Check for empty password fields
    if (empty($password) && empty($password2)) {
        $_SESSION['no_pass'] = true;
        header('location: ../edit.administrator.php?admin_id=' . $admin_id);
        exit();
    }

    // Check for password match
    if ($password !== $password2) {
        $_SESSION['password_unmatch'] = true;
        header('location: ../edit.administrator.php?admin_id=' . $admin_id);
        exit();
    } else {
        $hashpwd = password_hash($password, PASSWORD_BCRYPT);
        $updateUser = mysqli_query($conn, "UPDATE tbl_admins SET admin_fname = '$admin_fname', admin_mname = '$admin_mname', admin_lname = '$admin_lname', email = '$email', username = '$username', password = '$hashpwd' WHERE admin_id = '$admin_id'");

        if ($updateUser) {
            $_SESSION['success'] = true;
        } else {
            // Handle update failure
            $_SESSION['update_failed'] = true;
        }
        header('location: ../edit.administrator.php?admin_id=' . $admin_id);
        exit();
    }
}
?>
