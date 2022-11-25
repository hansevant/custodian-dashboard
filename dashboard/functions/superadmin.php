<?php

include '../../function.php';
session_start();
if ($_SESSION['role'] != 'superadmin') {
    echo "<script>alert('Forbidden!');location.href='../template.php'</script>";
}

if (isset($_GET["approve"])) {

    $value = $_GET["approve"];
    // ini belum cek lagi old role biar diupdate
    mysqli_query($conn, "UPDATE users SET is_approved = 1, updated_at = CURRENT_TIMESTAMP WHERE `id` =  '$value'");
    echo "<script>alert('Berhasil mengapprove user tersebut');location.href='../pendinguser.php'</script>";
}

if (isset($_GET["reject"])) {

    $value = $_GET["reject"];

    $data = mysqli_query($conn, "SELECT * FROM users WHERE id = '$value'");
    $row = mysqli_fetch_array($data);

    // untuk menerima kalau yang direject user lama jadi biar kembali ke role sebelumnya
    if ($row['is_approved'] == 2) {
        $data = mysqli_query($conn, "SELECT * FROM users WHERE id = '$value'");
        $row = mysqli_fetch_array($data);
        $oldrole = $row['oldrole'];
        mysqli_query($conn, "UPDATE users SET is_approved = 1, `role` = '$oldrole', updated_at = CURRENT_TIMESTAMP WHERE `id` = '$value'");
        echo "<script>alert('Berhasil mereject user tersebut');location.href='../pendinguser.php'</script>";
        exit;
    }
    // menghapus credential user yang direject agar usernamenya bisa dipakai lagi
    mysqli_query($conn, "DELETE FROM users WHERE `id` =  '$value'");
    echo "<script>alert('Berhasil mereject user tersebut');location.href='../pendinguser.php'</script>";
}
