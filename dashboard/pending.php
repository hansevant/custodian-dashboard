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
    <title>Dokumen Pending</title>
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
                                <h4 class="card-title float-left">Pending Dokumen</h4>

                                <hr class="mt-5">
                                <div class="table-responsive">
                                    <table style="color:#333;font-size: 14px;" id="myTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="30%">Dokumen</th>
                                                <th class="text-center" width="30%">Nasabah</th>
                                                <th class="text-center" width="25%">Jenis Perjanjian</th>
                                                <?php if ($_SESSION['role'] == 'Approver') { ?>
                                                    <th class="text-center" width="15%">Aksi</th>
                                                <?php } else { ?>
                                                    <th class="text-center" width="15%">Approver</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($_SESSION['role'] == 'Maker') {
                                                $sql = mysqli_query($conn, "SELECT docs.id_dokumen, docs.nama_dokumen, docs.nasabah, docs.jenis_perjanjian, users.name FROM docs INNER JOIN users ON docs.approver = users.id where docs.is_approved = 0");
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT docs.id_dokumen, docs.nama_dokumen, docs.nasabah, docs.jenis_perjanjian FROM docs where is_approved = 0 AND approver = '$_SESSION[id]'");
                                            }

                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>

                                                <tr>
                                                    <td><a href="doc.php?id_dokumen=<?= $data[0] ?>"><?= $data[1]; ?></a></td>
                                                    <td><?= $data[2]; ?></td>
                                                    <td><?= $data[3]; ?></td>
                                                    <?php if ($_SESSION['role'] == 'Approver') { ?>
                                                        <td>
                                                            <a href="functions/approver.php?approve=<?= $data[0] ?>" class="btn btn-sm btn-success" data-toggle="tooltip" title="Approve">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            <a href="functions/approver.php?reject=<?= $data[0] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Reject">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                            <a href="functions/approver.php?cancel=<?= $data[0] ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Cancel">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td><?= $data[4]; ?></td>
                                                    <?php } ?>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Dokumen</th>
                                                <th class="text-center">Nasabah</th>
                                                <th class="text-center">Jenis Perjanjian</th>
                                                <?php if ($_SESSION['role'] == 'Approver') { ?>
                                                    <th class="text-center">Aksi</th>
                                                <?php } else { ?>
                                                    <th class="text-center">Approver</th>
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