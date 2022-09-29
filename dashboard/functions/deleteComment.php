<?php
include '../../function.php';
session_start();
$value = $_GET['id_comment'];
$id_dokumen = $_GET['id_dokumen'];

$sql = mysqli_query($conn, "DELETE FROM comments WHERE id_comment = '$value'");


echo "<script>alert('Berhasil menghapus komentar!');
location.href='../doc.php?id_dokumen=$id_dokumen';</script>";
