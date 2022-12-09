<?php
session_start();
require('../function.php');
header("X-XSS-Protection: 1; mode=block");
if (!isset($_SESSION['login']) > 0) {
    echo "<script>location.href='../'</script>";
}
// die($_GET['id_dokumen']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/head.php"; ?>
    <title>Detail Document</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include "../partials/navbar.php" ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $active = 'y' ?>
        <?php include "../partials/sidebar.php" ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->

                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Sales Charts Section -->
                <!-- *************************************************************** -->

                <?php
                $id_dokumen = $_GET['id_dokumen'];

                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE id_dokumen = '$id_dokumen'");
                $sql2 = mysqli_query($conn, "SELECT * FROM activities WHERE id_dokumen = '$id_dokumen' ORDER BY created_at DESC LIMIT 4 ");
                $sql2y = mysqli_query($conn, "SELECT * FROM activities WHERE id_dokumen = '$id_dokumen' ORDER BY created_at DESC");
                $sql3 = mysqli_query($conn, "SELECT comments.id_comment, comments.id_user, comments.comment, comments.created_at, users.name, users.role FROM comments inner join users on comments.id_user=users.id WHERE id_dokumen = '$id_dokumen'");
                // $sql4 = mysqli_query($conn, "SELECT * FROM users inner join comments on users.id=comments.id_user ");

                $doc = mysqli_fetch_array($sql);

                $now = gmdate("Y-m-d", time());
                $remaining = strtotime($doc[8]) - time();
                $days_remaining = floor($remaining / 86400);
                $hours_remaining = floor(($remaining % 86400) / 3600);
                ?>

                <a download href="docs/<?= $doc[2]; ?>" class="btn waves-effect waves-light btn-rounded btn-primary"><i class="fas fa-download"></i> Download</a>
                <?php
                if ($_SESSION['role'] == 'Maker' && $doc[12] != 0) {
                ?>
                    <a href="edit.php?id=<?= $doc[0] ?>" class="float-right btn btn-warning btn-rounded waves-effect waves-light px-3">
                        <i class="icon-pencil"></i>
                        Edit</a>
                <?php
                }
                if ($_SESSION['role'] == 'Approver' && $doc[12] == 0) {
                ?>
                    <div class="float-right">
                        <a href="functions/Approver.php?approve=<?= $doc[0] ?>" data-toggle="tooltip" title="Approve" class="btn btn-success">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="functions/Approver.php?reject=<?= $doc[0] ?>" data-toggle="tooltip" title="Reject" class="btn btn-warning">
                            <i class="fas fa-times"></i>
                        </a>
                        <a href="functions/Approver.php?cancel=<?= $doc[0] ?>" data-toggle="tooltip" title="Cancel" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                <?php
                } ?>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title float-left">Dokumen <?= $doc[1]; ?></h4> -->
                                        <!-- <a href="">Download</a> -->
                                        <!-- <hr class="mt-4"> -->
                                        <iframe src="docs/<?= $doc[2]; ?>" type="application/pdf" height="800px" width="100%"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title float-left">Komentar</h4>
                                        <hr class="mt-4">
                                        <?php

                                        while ($comment = mysqli_fetch_array($sql3)) {
                                        ?>
                                            <h5 class="font-weight-medium" style="margin-bottom: 5px;"><?= $comment['name']; ?> <small>- <?= $comment['role']; ?></small></h5>
                                            <?php
                                            if ($_SESSION['id'] == $comment['id_user']) {
                                            ?>
                                                <a href="functions/comment.php?id_comment=<?= $comment['id_comment'] ?>&id_dokumen=<?= $doc[0] ?>" class="text-danger h3">
                                                    <i class="icon-trash float-right"></i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            <p><?= $comment['comment']; ?> <br> <span class="font-14 mb-2 text-muted">at <?= date('j F, Y g:i a', strtotime($comment['created_at'])); ?></span></p>

                                        <?php
                                        }
                                        ?>
                                        <?php if ($_SESSION['role'] != 'Operation' && $_SESSION['role'] != 'admin') {
                                        ?>
                                            <form class="mt-3" action="functions/comment.php" method="POST">
                                                <div class="form-group">
                                                    <input type="hidden" value="<?= $doc[0]; ?>" name="id_dokumen">
                                                    <textarea class="form-control" rows="3" placeholder="Text Here..." name="comment"></textarea>
                                                    <button type="submit" name="post_comment" class="btn waves-effect waves-light btn-rounded btn-primary mt-3 px-4 float-right">Send</button>
                                                </div>
                                            </form>
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title float-left">Detail Dokumen</h4>
                                        <hr class="mt-4">
                                        <p>Nama : <?= $doc[1]; ?></p>
                                        <p>Nasabah : <?= $doc[3]; ?></p>
                                        <p>Jenis Perjanjian : <?= $doc[4]; ?></p>
                                        <p>Nomor Perjanjian : <?= $doc[5]; ?></p>
                                        <p>Nomor Perjanjian Terkait : <?= $doc[6]; ?></p>
                                        <p>Tanggal Perjanjian : <?= $doc[7]; ?></p>
                                        <p>Tanggal Berakhir : <?= $doc[8]; ?></p>
                                        <p>Batas Review : <?= $doc[9]; ?></p>
                                        <p>Sisa Batas Review :
                                            <?php
                                            if ($now >= $doc[9] && $now < $doc[8]) {
                                                if ($days_remaining > 0) {
                                                    echo "$days_remaining hari dan $hours_remaining jam lagi<br>";
                                                } else {
                                                    echo "$hours_remaining jam lagi<br>";
                                                }
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </p>
                                        <p>Status : <?= $doc[10]; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="scrollableModalTitle">Log Aktivitas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="activity">
                                                <?php
                                                if ($sql2y->num_rows > 0) {
                                                    while ($log = mysqli_fetch_array($sql2y)) {
                                                ?>
                                                        <div class="d-flex align-items-start border-left-line pb-3">
                                                            <div>
                                                                <?php
                                                                if ($log[3] == 2) {
                                                                    echo ' <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                                        <i data-feather="upload"></i>
                                                                    </a> ';
                                                                } else if ($log[3] == 3) {
                                                                    echo ' <a href="javascript:void(0)" class="btn btn-primary btn-circle mb-2 btn-item">
                                                                        <i data-feather="edit-3"></i>
                                                                    </a> ';
                                                                } else if ($log[3] == 1) {
                                                                    echo ' <a href="javascript:void(0)" class="btn btn-success btn-circle mb-2 btn-item">
                                                                        <i data-feather="check"></i>
                                                                    </a> ';
                                                                } else if ($log[3] == 0) {
                                                                    echo ' <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                                                        <i data-feather="x"></i>
                                                                    </a> ';
                                                                } else if ($log[3] == 4) {
                                                                    echo ' <a href="javascript:void(0)" class="btn btn-warning btn-circle mb-2 btn-item">
                                                                        <i data-feather="trash-2"></i>
                                                                    </a> ';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="ml-3 mt-2">
                                                                <h5 class="text-dark font-weight-medium mb-2"><?= $log[2]; ?></h5>
                                                                <p class="font-14 mb-2 text-muted"><?= date('j F, Y', strtotime($log[4])) ?>
                                                                </p>
                                                                <span class="font-weight-light font-14 text-muted"><?= date('g:i a', strtotime($log[4])) ?></span>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title float-left">Log Aktivitas</h4>
                                        <hr class="mt-4">
                                        <div class="activity">
                                            <?php
                                            if ($sql2->num_rows > 0) {
                                                while ($log = mysqli_fetch_array($sql2)) {
                                            ?>
                                                    <div class="d-flex align-items-start border-left-line pb-3">
                                                        <div>
                                                            <?php
                                                            if ($log[3] == 2) {
                                                                echo ' <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                                                        <i data-feather="upload"></i>
                                                                    </a> ';
                                                            } else if ($log[3] == 3) {
                                                                echo ' <a href="javascript:void(0)" class="btn btn-primary btn-circle mb-2 btn-item">
                                                                        <i data-feather="edit-3"></i>
                                                                    </a> ';
                                                            } else if ($log[3] == 1) {
                                                                echo ' <a href="javascript:void(0)" class="btn btn-success btn-circle mb-2 btn-item">
                                                                        <i data-feather="check"></i>
                                                                    </a> ';
                                                            } else if ($log[3] == 0) {
                                                                echo ' <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                                                        <i data-feather="x"></i>
                                                                    </a> ';
                                                            } else if ($log[3] == 4) {
                                                                echo ' <a href="javascript:void(0)" class="btn btn-warning btn-circle mb-2 btn-item">
                                                                        <i data-feather="trash-2"></i>
                                                                    </a> ';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="ml-3 mt-2">
                                                            <h5 class="text-dark mb-2"><?= $log[2]; ?></h5>
                                                            <p class="font-14 mb-2 text-muted"><?= date('j F, Y', strtotime($log[4])) ?>
                                                            </p>
                                                            <span class="font-weight-light font-14 text-muted"><?= date('g:i a', strtotime($log[4])) ?></span>
                                                        </div>
                                                    </div>
                                                <?php
                                                } ?>
                                        </div>
                                        <a href="javascript:void(0)" class="float-right" data-toggle="modal" data-target="#scrollable-modal">loadmore..</a>
                                        <!-- <button type="button" class="btn btn-secondary" >Scrollable modal</button> -->
                                    <?php
                                            } else { ?>
                                        <p>No Logs</p>
                                    <?php
                                            }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End Sales Charts Section -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Location and Earnings Charts Section -->
                <!-- *************************************************************** -->

                <!-- *************************************************************** -->
                <!-- End Location and Earnings Charts Section -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Top Leader Table -->

                <!-- *************************************************************** -->
                <!-- End Top Leader Table -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                All Rights Reserved by Bank Rakyat Indonesia. Designed and Developed by <a href="#">Custodian</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?php include "../partials/script.php" ?>
</body>

</html>