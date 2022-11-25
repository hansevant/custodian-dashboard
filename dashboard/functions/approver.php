<?php

include '../../function.php';
session_start();
if ($_SESSION['role'] != 'Approver') {
    echo "<script>alert('Forbidden!');location.href='../'</script>";
    exit;
}

if (isset($_GET["approve"])) {

    $value = $_GET["approve"];
    $user = $_SESSION['name'];
    $comment = "$user telah mengapprove Dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 1, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            1)
            ");
    echo "<script>alert('Dokumen telah diapprove');location.href='../docs.php'</script>";
}

if (isset($_GET["reject"])) {

    $value = $_GET["reject"];
    $user = $_SESSION['name'];
    $comment = "$user telah mereject Dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 2, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            0)
            ");
    echo "<script>alert('Dokumen telah direject');location.href='../pending.php'</script>";
}

if (isset($_GET["cancel"])) {

    $value = $_GET["cancel"];
    $user = $_SESSION['name'];
    $comment = "$user telah mencancel Dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 3, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            4)
            ");
    echo "<script>alert('Dokumen telah dicancel');location.href='../pending.php'</script>";
}
