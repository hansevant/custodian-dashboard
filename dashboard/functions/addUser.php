<?php
include '../../function.php';
session_start();

$name = $_POST['name'];
$username = $_POST['username'];
$role = $_POST['role'];

$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'"));
if ($check > 0) {
    echo "<script>alert('Failed! username already exist, please choose another username');
    location.href='../adduser.php'</script>";
} else {
    $sql = mysqli_query($conn, "INSERT INTO users (`name`, username, `password`, `role`) VALUES ('$name', '$username' , PASSWORD(12345678) ,'$role')");
    echo "<script>alert('successfully added new user');
    location.href='../accounts.php'</script>";
}
