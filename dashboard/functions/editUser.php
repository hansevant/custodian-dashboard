<?php

include '../../function.php';
session_start();

$id = $_POST['id'];
$username = $_POST['username'];
$oldusername = $_POST['oldusername'];
$role = $_POST['role'];

$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'"));
if ($oldusername == $username) {
    $sql = mysqli_query($conn, "UPDATE users SET `role` = '$role' WHERE id = '$id'");
    echo "<script>alert('successfully added new user');
    location.href='../accounts.php'</script>";
} else {
    if ($check > 0) {
        echo "<script>alert('Failed! username already exist, please choose another username');
        location.href='../edituser.php?id=$id'</script>";
    } else {
        $sql = mysqli_query($conn, "UPDATE users SET username = '$username', `role` = '$role' WHERE id = '$id'");
        echo "<script>alert('successfully added new user');
    location.href='../accounts.php'</script>";
    }
}
