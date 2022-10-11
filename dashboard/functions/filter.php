<?php

include '../../function.php';
session_start();

if (isset($_POST['simpan'])) {
    // foreach ($_POST['hobi'] as $value) {
    //     echo $value . ',';
    // }
    $and = 'is_approved = 1';
    if (!empty($_POST['status'])) {
        $filter = implode(",", $_POST['status']);
        $and .= " AND `status` IN ($filter)";
    }
    if (!empty($_POST['type'])) {
        $filter2 = implode(",", $_POST['type']);
        $and .= " AND jenis_perjanjian IN ($filter2)";
    }
    if (!empty($_POST['firstdate']) && !empty($_POST['lastdate'])) {
        $fd = $_POST['firstdate'];
        $ld = $_POST['lastdate'];
        // echo $_POST['lastdate'];
        // echo $_POST['firstdate'];
        $and .= " AND tanggal_perjanjian BETWEEN '$fd' AND '$ld'";
    }
    $data = mysqli_query($conn, "SELECT * FROM docs WHERE " . $and);
} else {
    $data = mysqli_query($conn, "SELECT * FROM docs WHERE is_approved = 1");
}
