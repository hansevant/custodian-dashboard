<!DOCTYPE html>
<html lang="en">
<?php

$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

// $sql4 = mysqli_query($conn, "SELECT * FROM users inner join comments on users.id=comments.id_user");

$conn = mysqli_connect($server, $username, $pw, $db);

$select_id = mysqli_query($conn, "SELECT COUNT(*) AS idTerbesar FROM docs");

if ($select_id == FALSE) {
    $id_doc = 1;
} else {
    $cek = mysqli_fetch_array($select_id);
    $id_doc = $cek['idTerbesar'];
    $id_doc++;
    $id_doc = 'DOC/CUS-' . $id_doc;
}

echo $id_doc;

echo "<br>" . md5(123);
// $now = '2022-09-02';
$deadline = '2022-10-03';
// $date = new DateTime($now);
// $timestamp = $date->getTimestamp();
$now = gmdate("Y-m-d", time());
$batas = date("Y-m-d", strtotime($deadline . '-1 month'));
// echo $now . '</br>';
// echo $deadline . '</br>';
// echo $batas  . '</br>';
$remaining = strtotime($deadline) - time();
$days_remaining = floor($remaining / 86400);
$hours_remaining = floor(($remaining % 86400) / 3600);

// if ($now >= $batas && $now < $deadline) {
//     echo 'masa review  <br>';
//     echo "sisa $days_remaining hari dan $hours_remaining jam lagi";
// } else if ($now >= $deadline) {
//     echo 'tidak berlaku';
// } else {
//     echo 'berlaku';
// }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dokumen</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <a href="index.php?filter=berlaku">s b</a>
    <a href="index.php">reset</a>
    <hr>
    <table style="width:60%">

        <tr>
            <th>#</th>
            <th>nama</th>
            <th>dokumen</th>
            <th>nasabah</th>
            <th>jenis_perjanjian</th>
            <th>nomor_perjanjian</th>
            <th>nomor_perjanjian_terkait</th>
            <th>tanggal_perjanjian</th>
            <th>tanggal_berakhir</th>
            <th>masa_review</th>
            <th>sisa_batas_review</th>
            <th>status</th>
        </tr>

        <?php

        // ambil data dan penomoran
        if (isset($_GET["filter"])) {
            $value = $_GET['filter'];
            $data = mysqli_query($conn, "SELECT * FROM docs WHERE `status` =  '$value'");
        } else {
            $data = mysqli_query($conn, "SELECT * FROM docs");
        }
        $n = 1;

        while ($row = mysqli_fetch_array($data)) {
            // logic batas review
            $now = gmdate("Y-m-d", time());
            $remaining = strtotime($row[8]) - time();
            $days_remaining = floor($remaining / 86400);
            $hours_remaining = floor(($remaining % 86400) / 3600);
            $masa_review = date("Y-m-d", strtotime($row[8] . '-1 month'));

            if ($now >= $masa_review && $now < $row[8]) {
                $status = 'Masa Review';
            } else if ($now >= $row[8] || $now < $row[7]) {
                $status = 'Tidak Berlaku';
            } else {
                $status = 'Berlaku';
            }

        ?>
            <tr>
                <td><?= $n; ?></td>
                <td><?= $row[1]; ?></td>
                <td><?= $row[2]; ?></td>
                <td><?= $row[3]; ?></td>
                <td><?= $row[4]; ?></td>
                <td><?= $row[5]; ?></td>
                <td><?= $row[6]; ?></td>
                <td><?= $row[7]; ?></td>
                <td><?= $row[8]; ?></td>
                <td><?= $masa_review; ?></td>
                <td><?php
                    if ($now >= $row[9] && $now < $row[8]) {
                        echo "sisa waktu : $days_remaining hari dan $hours_remaining jam lagi<br>";
                    } else {
                        echo '-';
                    }
                    ?></td>
                <td><?= $status; ?></td>
            </tr>
        <?php
            $n++;
        } ?>
    </table>
</body>

</html>