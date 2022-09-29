<?php

include '../../function.php';
session_start();
if ($_GET['id']) {
    $id = $_GET['id'];

    $sql = mysqli_query($conn, "UPDATE users SET `password` = PASSWORD('custodian2023'), reset_pass = 1 WHERE id = '$id'");

    echo "<script>
alert('Berhasil mereset passwordnya');
location.href='../accounts.php'
</script>";
}

if ($_POST['submit_cp']) {

    $oldpass    =  mysqli_real_escape_string($con, $_POST['oldpassword']);
    $newpass    =  mysqli_real_escape_string($con, $_POST['newpassword']);
    $cpass    =  mysqli_real_escape_string($con, $_POST['newpassword2']);

    $rpass = mysqli_query($conn, "SELECT `password` FROM users where id = '$id'");

    if ($newpass == $cpass) {

        $query = mysqli_query($con, "UPDATE acc_user 
                                SET `password` = PASSWORD('$newpass'),
                                    reset_pass = 0
                                WHERE id_user = '$_SESSION[id]' ");
        if ($query) {
            echo "<script>alert('Password berhasil diubah'); 
                                            location.href='../leader/index.php' </script>";
        } else {
            echo "<script>alert('Password gagal diubah'); 
                                            location.href='../leader/changepass.php' </script>";
        }
    } else {
        echo "<script>alert('Password tidak sama mohon ulangi'); 
                    location.href='../account.php' </script>";
    }
}
