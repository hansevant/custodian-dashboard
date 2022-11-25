<?php

include '../../function.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Forbidden!');location.href='../template.php'</script>";
}

if (isset($_POST["editrole"])) {
    $id = $_POST['id'];
    // $username = $_POST['username'];
    // $oldusername = $_POST['oldusername'];
    $role = $_POST['role'];

    $sql = mysqli_query($conn, "UPDATE users SET `role` = '$role', is_approved = 2 WHERE id = '$id'");
    echo "<script>alert('successfully update the user');
        location.href='../accounts.php'</script>";
}

if (isset($_GET["activateuser"])) {

    $id = $_GET["activateuser"];

    $sql = mysqli_query($conn, "UPDATE users SET `status` = 1 , `login_time` = 0 WHERE id = '$id'");
    echo "<script>alert('successfully activate or unlock the user');
    location.href='../edituser.php?id=$id'</script>";
}

if (isset($_GET["disableuser"])) {

    $id = $_GET["disableuser"];

    $sql = mysqli_query($conn, "UPDATE users SET `status` = 0 WHERE id = '$id'");
    echo "<script>alert('successfully disabled the user');
    location.href='../edituser.php?id=$id'</script>";
}

if (isset($_GET["resetpass"])) {

    $id = $_GET["resetpass"];

    $resetpass = password_hash('custodithebest', PASSWORD_DEFAULT);
    $sql = mysqli_query($conn, "UPDATE users SET `password` = '$resetpass', reset_pass = 1, `status` = 1 , `login_time` = 0 WHERE id = '$id'");
    echo "<script>alert('successfully reset the password');
    location.href='../edituser.php?id=$id'</script>";
}
