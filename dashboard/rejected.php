<?php
session_start();
require('../function.php');
header("X-XSS-Protection: 1; mode=block");
if (!isset($_SESSION['login']) > 0) {
    echo "<script>location.href='../'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- This page plugin datatables CSS -->
    <link href="../src/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <?php include "../partials/head.php"; ?>
    <title>Rejected Document</title>
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
        <?php $active = 'z' ?>
        <?php include "../partials/sidebar.php" ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title float-left">Rejected Dokumen</h4>

                                <hr class="mt-5">
                                <div class="table-responsive">
                                    <table style="color:#333;font-size: 14px;" id="myTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Dokumen</th>
                                                <th class="text-center">Nasabah</th>
                                                <th class="text-center">Jenis Perjanjian</th>
                                                <th class="text-center">Status</th>
                                                <?php if ($_SESSION['role'] == 'Maker') { ?>
                                                    <th class="text-center">Aksi</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            if (!$i) {

                                                $sql = mysqli_query($conn, "SELECT * FROM docs where `status` = 'berlaku'");
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs where is_approved = 2");
                                            }

                                            $n = 1;
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $now = gmdate("Y-m-d", time());
                                                $remaining = strtotime($data[8]) - time();
                                                $days_remaining = floor($remaining / 86400);
                                                $hours_remaining = floor(($remaining % 86400) / 3600);
                                            ?>

                                                <tr>
                                                    <td><a href="doc.php?id_dokumen=<?= $data[0] ?>"><?= $data[1]; ?></a></td>
                                                    <td><?= $data[3]; ?></td>
                                                    <td><?= $data[4]; ?></td>
                                                    <td><?= $data[10]; ?></td>
                                                    <?php if ($_SESSION['role'] == 'Maker') { ?>
                                                        <td>
                                                            <!-- <a href="edit.php?id=<?= $data[0]; ?>" class="btn btn-success">
                                                                <i class="icon-pencil"></i> Edit
                                                            </a> -->
                                                            <i class="fas fa-pencil-alt text-primary font-12 mr-1"></i>
                                                            <a href="edit.php?id=<?= $data[0]; ?>">
                                                                Edit
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Dokumen</th>
                                                <th class="text-center">Nasabah</th>
                                                <th class="text-center">Jenis Perjanjian</th>
                                                <th class="text-center">Status</th>
                                                <?php if ($_SESSION['role'] == 'Maker') { ?>
                                                    <th class="text-center">Aksi</th>
                                                <?php } ?>
                                            </tr>
                                        </tfoot>
                                    </table>
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

    <!-- Data Table -->
    <?php include "../partials/script.php" ?>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="../src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
</body>

</html>