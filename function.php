<?php

$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

$conn = mysqli_connect($server, $username, $pw, $db);

$sql = mysqli_query($conn, "SELECT * FROM docs");

$datenow = gmdate("Y-m-d", time());
// echo $datenow . '<br><br>';

$data = mysqli_fetch_row($sql);
// if ($datenow < $data[8]) {
//     // echo 'berlaku' . '<br>';
//     $query = mysqli_query($conn, "UPDATE docs set `status` = 'berlaku' WHERE tanggal_berakhir ");
// } else {
//     // echo 'tidak berlaku' . '<br>';
//     $query = mysqli_query($conn, "UPDATE docs set `status` = 'tidak berlaku' ");
// }

while ($data = mysqli_fetch_row($sql)) {
    //     // if ($datenow > $data[8]) {
    //     // echo 'status : ' . "tidak berlaku" . '<br>';
    //     // } else if ($datenow >= $data[9]) {
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'berlaku' where tanggal_perjanjian <= '$datenow' && batas_review > '$datenow'");
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'masa review' where batas_review <= '$datenow' && tanggal_berakhir >= '$datenow'");
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'tidak berlaku' where tanggal_berakhir <= '$datenow' || tanggal_perjanjian > '$datenow'");
    //     // } else if ($datenow < $data[8]) {
}

//     // $now = gmdate("Y-m-d", time());
//     // $remaining = strtotime($data[8]) - time();
//     // $days_remaining = floor($remaining / 86400);
//     // $hours_remaining = floor(($remaining % 86400) / 3600);

//     // echo 'status : ' . $data[10] . '<br>';
//     // if ($now >= $data[9] && $now < $data[8]) {
//     //     echo "sisa waktu : $days_remaining hari dan $hours_remaining jam lagi<br>";
//     // }
//     // echo 'batas review : ' . $data[9] . '<br>';
//     // echo 'tgl berakhir : ' . $data[8] . '<br>';
//     // echo 'tgl perjanjian : ' . $data[7] . '<br>';

//     // echo '<br>';
// }
