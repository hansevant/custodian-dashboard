<?php

include '../../function.php';
session_start();

$nama_dokumen = $_POST['nama_dokumen'];
$nasabah = $_POST['nasabah'];
$jenis_perjanjian = $_POST['jenis_perjanjian'];
$nomor_perjanjian = $_POST['nomor_perjanjian'];
$nomor_perjanjian_terkait = $_POST['nomor_perjanjian_terkait'];
$tanggal_perjanjian = $_POST['tanggal_perjanjian'];
$tanggal_berakhir = $_POST['tanggal_berakhir'];
$approver = $_POST['approver'];
$datenow = gmdate("Y-m-d", time());
$batas_review = date("Y-m-d", strtotime($tanggal_berakhir . '-1 month'));

if ($datenow >= $batas_review && $datenow < $tanggal_berakhir) {
    $status = 'Masa Review';
} else if ($datenow >= $tanggal_berakhir || $datenow < $tanggal_perjanjian) {
    $status = 'Tidak Berlaku';
} else {
    $status = 'Berlaku';
}

// dokumen upload

$random_number = round(microtime(true));
$file_name = $_FILES['dokumen']['name'];
$format = $_FILES['dokumen']['type'];
$file_tmp = $_FILES['dokumen']['tmp_name'];
$new_file_name = $random_number . '_' . $file_name;

// membuat id dokumen

$select_id = mysqli_query($conn, "SELECT COUNT(*) AS idTerbesar FROM docs");

if ($select_id == FALSE) {
    $id_doc = 1;
} else {
    $cek = mysqli_fetch_array($select_id);
    $id_doc = $cek['idTerbesar'];
    $id_doc++;
    $id_doc = 'DOC/CUS-' . $id_doc;
}

if ($format == "application/pdf") {
    @move_uploaded_file($file_tmp, "../docs/" . $new_file_name);

    $sql = mysqli_query($conn, "INSERT INTO `docs` (id_dokumen, nama_dokumen, dokumen, nasabah, jenis_perjanjian, nomor_perjanjian, nomor_perjanjian_terkait, tanggal_perjanjian, tanggal_berakhir, batas_review,`status`, approver) 
    VALUES ('$id_doc',
            '$nama_dokumen',
            '$new_file_name',
            '$nasabah',
            '$jenis_perjanjian',
            '$nomor_perjanjian', 
            '$nomor_perjanjian_terkait',
            '$tanggal_perjanjian',
            '$tanggal_berakhir',
            '$batas_review', 
            '$status',
            '$approver')
            ");

    $user = $_SESSION['name'];
    $comment = "$user telah mengunggah Dokumen ini";

    $sql .= mysqli_query($conn, "INSERT INTO activities (id_dokumen, `log`, activity_code)
    VALUES ('$id_doc',
            '$comment',
            2)
            ");

    echo "<script>alert('Berhasil menambah dokumen');
    location.href='../';</script>";
} else {
    echo "<script>alert('Maaf format file hanya bisa PDF');
    location.href='../upload.php';</script>";
}
