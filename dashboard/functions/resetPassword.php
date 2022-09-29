<?php

include '../../function.php';
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($conn, "UPDATE users SET `password` = PASSWORD('custodian2023'), reset_pass = 1 WHERE id = '$id'");

    echo "<script>
alert('Berhasil mereset passwordnya');
location.href='../accounts.php'
</script>";
}

if (isset($_POST['submit_cp'])) {

    $oldpass    =  mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpass    =  mysqli_real_escape_string($conn, $_POST['newpassword']);
    $cpass    =  mysqli_real_escape_string($conn, $_POST['newpassword2']);

    $rpass = mysqli_fetch_row(mysqli_query($conn, "SELECT `password` FROM users where id = '$_SESSION[id]'"));

    if (md5($oldpass) == $rpass[0]) {
        if ($newpass == $cpass) {

            $pass = md5($newpass);
            $query = mysqli_query($conn, "UPDATE users 
                                SET `password` = '$pass',
                                    reset_pass = 0
                                WHERE id = '$_SESSION[id]' ");
            if ($query) {
                echo "<script>alert('Password berhasil diubah'); 
                                            location.href='../account.php' </script>";
            } else {
                echo "<script>alert('Password gagal diubah'); 
                                            location.href='../account.php' </script>";
            }
        } else {
            echo "<script>alert('Password tidak sama mohon ulangi'); 
                    location.href='../account.php' </script>";
        }
    } else {
        echo "<script>alert('Password salah mohon masukan password lama yang benar'); 
                    location.href='../account.php' </script>";
    }
}
