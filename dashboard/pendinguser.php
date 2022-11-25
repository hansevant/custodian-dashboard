<?php
session_start();
require('../function.php');
header("X-XSS-Protection: 1; mode=block");
if (!isset($_SESSION['login']) > 0) {
    echo "<script>location.href='../'</script>";
}
if ($_SESSION['role'] != 'superadmin' && $_SESSION['role'] != 'admin') {
    echo "<script>location.href='index.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- This page plugin datatables CSS -->
    <link href="../src/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <?php include "../partials/head.php"; ?>
    <title>Pending User</title>
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
        <?php $active = 'c' ?>
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
                                <h4 class="card-title float-left">Pending User</h4>

                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <div class="btn-group float-right">
                                        <div class="float-right">
                                            <a href="adduser.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Add New User</a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr class="mt-5">
                                <div class="table-responsive">
                                    <table style="font-size: 14px;" id="myTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <?php if ($_SESSION['role'] == 'superadmin') { ?>
                                                    <th style="width: 150px;">Actions</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE `role` <> 'admin' AND `role` <> 'admin' AND is_approved <> 1");

                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>

                                                <tr>
                                                    <td><?= $data[1]; ?></td>
                                                    <td><?= $data[2]; ?></td>
                                                    <td><?= $data[4]; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($data[6] == 1) {
                                                            echo "<i class='fas fa-circle text-success font-10 mr-2'></i>Active";
                                                        } elseif ($data[6] == 2) {
                                                            echo "<i class='fas fa-circle text-warning font-10 mr-2'></i>Locked";
                                                        } else {
                                                            echo "<i class='fas fa-circle text-danger font-10 mr-2'></i>Disabled";
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php if ($_SESSION['role'] == 'superadmin') { ?>
                                                        <td>
                                                            <a href="functions/superadmin.php?approve=<?= $data[0] ?>" class="bg-light p-2 mr-2">
                                                                <i class="fas fa-check text-primary font-12 mr-1"></i>Approve
                                                            </a>
                                                            <a href="functions/superadmin.php?reject=<?= $data[0] ?>" class="bg-light p-2">
                                                                <i class="fas fa-window-close text-primary font-12 mr-1"></i>Reject
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <?php if ($_SESSION['role'] == 'superadmin') { ?>
                                                    <th>Actions</th>
                                                <?php } ?>
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