<?php

include '../../function.php';
session_start();
if ($_SESSION['role'] != 'CS') {
    echo "<script>alert('Forbidden!');location.href='../template.php'</script>";
}

if (isset($_GET["approve"])) {

    $value = $_GET["approve"];
    $user = $_SESSION['name'];
    $comment = "$user telah mengapprove dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 1, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            1)
            ");
    echo "<script>alert('Berhasil mengapprove dokumen tersebut');location.href='../docs.php'</script>";
}

if (isset($_GET["reject"])) {

    $value = $_GET["reject"];
    $user = $_SESSION['name'];
    $comment = "$user telah mereject dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 2, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            0)
            ");
    echo "<script>alert('Berhasil mereject dokumen tersebut');location.href='../pending.php'</script>";
}

if (isset($_GET["cancel"])) {

    $value = $_GET["cancel"];
    $user = $_SESSION['name'];
    $comment = "$user telah mencancel dokumen ini";

    mysqli_query($conn, "UPDATE docs SET is_approved = 3, updated_at = CURRENT_TIMESTAMP WHERE `id_dokumen` =  '$value'");
    mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$value',
            '$comment',
            4)
            ");
    echo "<script>alert('Berhasil mencancel dokumen tersebut');location.href='../pending.php'</script>";
}
