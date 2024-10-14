<?php
include '../../../includes/session.php';

$student_id = $_GET['student_id'];

if (isset($_POST['upload'])) {
    if (empty($_FILES['image']['tmp_name'])) {
        $_SESSION['no_image'] = true;
        header('location: ../edit.student.php?student_id=' . $student_id);
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $set_userInfo = mysqli_query($conn, "UPDATE tbl_students SET img = '$image' WHERE student_id = '$student_id'");
        $_SESSION['success'] = true;
        header('location: ../edit.student.php?student_id=' . $student_id);
    }
} elseif (isset($_POST['submit'])) {
    $student_fname = mysqli_real_escape_string($conn, $_POST['student_fname']);
    $student_mname = mysqli_real_escape_string($conn, $_POST['student_mname']);
    $student_lname = mysqli_real_escape_string($conn, $_POST['student_lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    if (empty($password) && empty($password2)) {
        $_SESSION['no_pass'] = true;
        header('location: ../edit.student.php?student_id=' . $student_id);
    } else {
        if ($password != $password2) {
            $_SESSION['password_unmatch'] = true;
            header('location: ../edit.student.php?student_id=' . $student_id);
        } else {
            $hashpwd = password_hash($password, PASSWORD_BCRYPT);
            $updateStudent = mysqli_query($conn, "UPDATE tbl_students SET student_fname = '$student_fname', student_mname = '$student_mname', student_lname = '$student_lname', email = '$email', username = '$username', password = '$hashpwd' WHERE student_id = '$student_id'");
            $_SESSION['success'] = true;
            header('location: ../edit.student.php?student_id=' . $student_id);
        }
    }
}
?>
