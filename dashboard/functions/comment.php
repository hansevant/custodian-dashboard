<?php
session_start();
include '../../function.php';

$id_user = $_SESSION['id'];
$id_dokumen = $_POST['id_dokumen'];
$value = $_POST['comment'];

$sql = mysqli_query($conn, "INSERT INTO comments (id_user,id_dokumen,comment) VALUES ('$id_user','$id_dokumen','$value')");

echo "<script>location.href='../doc.php?id_dokumen=$id_dokumen';</script>";
