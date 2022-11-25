<?php

$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

$conn = mysqli_connect($server, $username, $pw, $db);

$sql = mysqli_query($conn, "SELECT * FROM docs");

$datenow = gmdate("Y-m-d", time());

$data = mysqli_fetch_row($sql);

while ($data = mysqli_fetch_row($sql)) {
    //     // if ($datenow > $data[8]) {
    //     // echo 'status : ' . "tidak berlaku" . '<br>';
    //     // } else if ($datenow >= $data[9]) {
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'Berlaku' where tanggal_perjanjian <= '$datenow' && batas_review > '$datenow'");
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'Masa Review' where batas_review <= '$datenow' && tanggal_berakhir >= '$datenow'");
    $query = mysqli_query($conn, "UPDATE docs set `status` = 'Tidak Berlaku' where tanggal_berakhir <= '$datenow' || tanggal_perjanjian > '$datenow'");
    //     // } else if ($datenow < $data[8]) {
}
