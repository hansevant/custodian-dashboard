<?php
include '../../function.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Forbidden!');location.href='../template.php'</script>";
}

$name = $_POST['name'];
$username = $_POST['username'];
$role = $_POST['role'];
$password = password_hash('memberimaknaindonesia', PASSWORD_DEFAULT);

$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'"));
if ($check > 0) {
    echo "<script>alert('Failed! username already exist, please choose another username');
    location.href='../adduser.php'</script>";
} else {
    $sql = mysqli_query($conn, "INSERT INTO users (`name`, username, `password`, `role` , oldrole) VALUES ('$name', '$username' , '$password' ,'$role', '$role')");
    echo "<script>alert('successfully added new user');
    location.href='../accounts.php'</script>";
}
