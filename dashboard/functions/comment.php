<?php
session_start();
include '../../function.php';

if (isset($_POST['post_comment'])) {
    $id_user = $_SESSION['id'];
    $id_dokumen = $_POST['id_dokumen'];
    $value = $_POST['comment'];

    $sql = mysqli_query($conn, "INSERT INTO comments (id_user,id_dokumen,comment) VALUES ('$id_user','$id_dokumen','$value')");

    echo "<script>location.href='../doc.php?id_dokumen=$id_dokumen';</script>";
}

if (isset($_GET['id_comment'])) {
    $value = $_GET['id_comment'];
    $id_dokumen = $_GET['id_dokumen'];

    $sql = mysqli_query($conn, "DELETE FROM comments WHERE id_comment = '$value'");

    echo "<script>alert('Berhasil menghapus komentar!');
location.href='../doc.php?id_dokumen=$id_dokumen';</script>";
}
