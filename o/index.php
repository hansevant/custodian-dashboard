<!DOCTYPE html>
<html lang="en">
<?php

$server = "localhost";
$username = "root";
$pw = "";
$db = "cutodi";

// $sql4 = mysqli_query($conn, "SELECT * FROM users inner join comments on users.id=comments.id_user");

$conn = mysqli_connect($server, $username, $pw, $db);
echo password_hash('superadmin', PASSWORD_DEFAULT);
echo ' -superadmin admin-  ';
echo password_hash('admin', PASSWORD_DEFAULT);

// if (password_verify('custodian2023', '$2y$10$LbgGhhiPJ4A0Xs3CjcyiPOu936Exl55y9iI0Ibdhg/94TGgCLylI6')) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }

$sql = mysqli_query($conn, "SELECT * from users where username = 'evan'");
$row = mysqli_fetch_array($sql);
$ban = $row['is_disabled'];
echo $ban . "<br>";
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
date_default_timezone_set("Asia/Bangkok");
echo "<br>" . md5(123);
// $now = '2022-09-02';
$deadline = '2022-10-03';
// $date = new DateTime($now);
// $timestamp = $date->getTimestamp();
$now = gmdate("l jS F Y ", time());
$batas = date("Y-m-d", strtotime($deadline . '-1 month'));
echo  '</br>' . gmdate("Y", time()) . '</br>';
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
    <form method="POST">
        <table>
            <tr>
                <td width="60px" valign="top">Status</td>
                <td valign="top">
                    <label><input type="checkbox" name="hobi[]" value="'Berlaku'">Berlaku</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Tidak Berlaku'">Tidak Berlaku</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Masa Review'">MR</label><br>
                </td>
            </tr>
            <tr>
                <td width="60px" valign="top">Jenis</td>
                <td valign="top">
                    <label><input type="checkbox" name="hoby[]" value="'Selling Agent'">Selling Agent</label><br>
                    <label><input type="checkbox" name="hoby[]" value="'Reksadana'">Reksadana</label><br>
                    <label><input type="checkbox" name="hoby[]" value="'KPD (Kontrak Pengelolaan Dana)'">KPD (Kontrak Pengelolaan Dana)</label><br>
                    <label><input type="checkbox" name="hoby[]" value="'SLA (Service Level Agreement)'">SLA (Service Level Agreement)</label><br>
                </td>
            </tr>
            <tr>
                <td width="60px" valign="top">Tanggal</td>
                <td valign="top">
                    <label><input type="date" name="firstdate"> Awal</label><br>
                    <label><input type="date" name="lastdate"> Akhir</label><br>
                </td>
            </tr>
            <tr>
                <td width="60px" valign="top"></td>
                <td valign="top">
                    <input type="submit" name="simpan" value="Simpan">
                </td>
            </tr>
        </table>
    </form>
    <table style="width:60%">
        <hr>

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
        if (isset($_POST['simpan'])) {
            // foreach ($_POST['hobi'] as $value) {
            //     echo $value . ',';
            // }
            $and = 'is_approved = 1';
            if (!empty($_POST['hobi'])) {
                $filter = implode(",", $_POST['hobi']);
                $and .= " AND `status` IN ($filter)";
            }
            if (!empty($_POST['hoby'])) {
                $filter2 = implode(",", $_POST['hoby']);
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
        ?>

        <?php

        // ambil data dan penomoran
        // if (isset($_GET["filter"])) {
        //     $value = $_GET['filter'];
        //     $data = mysqli_query($conn, "SELECT * FROM docs WHERE `status` =  '$value'");
        // } else {
        //     $data = mysqli_query($conn, "SELECT * FROM docs");
        // }
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

    <form action="" method="post">
        <select name="main_cat" id="main_cat">
            <option value="null" disabled selected>Select Category</option>

        </select>
        </br>
        <select name="sub_cat" id="sub-category-dropdown">
            <option value="">Select SubCategory</option>
        </select>
        </br>
        <input type="text" name="ad_brand" Placeholder="Brand(Cat,Jcb,Doosan)">
        </br>
        <label for="for_r_S">Price</label>
        <div class="range_sliders">
            <input type="text" name="min_range" Placeholder="Min">
            <span> - </span>
            <input type="text" name="max_range" Placeholder="Max">
        </div>
        </br>
        <label for="for_r_S">For Rent</label>
        <input type="radio" name="for_r_s" id="for_r_s" value="1">
        <label for="for_r_S">For Sale</label>
        <input type="radio" name="for_r_s" id="for_r_s" value="2">
        </br>
        <div id="content"></div>
        <button type="submit" name="filter_button" class="filter_button">Search</button>
    </form>

    <form method="POST">
        <table>
            <tr>
                <td width="60px" valign="top">Hobi</td>
                <td valign="top">
                    <label><input type="checkbox" name="hobi[]" value="'Nonton'">Nonton</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Menulis'">Menulis</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Traveling'">Traveling</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Otomotif'">Otomotif</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Fotografi">Fotografi</label><br>
                    <label><input type="checkbox" name="hobi[]" value="'Programming'">Programming</label>
                </td>
            </tr>
            <tr>
                <td width="60px" valign="top"></td>
                <td valign="top">
                    <input type="submit" name="simpan" value="Simpan">
                </td>
            </tr>
        </table>
    </form>

</body>

</html>