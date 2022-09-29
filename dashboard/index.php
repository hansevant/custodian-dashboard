<?php
session_start();
require('../function.php');
header("X-XSS-Protection: 1; mode=block");
if (!isset($_SESSION['id']) > 0) {
    echo "<script>location.href='../'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "partials/head.php"; ?>
    <title>Dashboard</title>
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
        <?php include "partials/navbar.php" ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $active = 'x' ?>
        <?php include "partials/sidebar.php" ?>
        <?php
        // status dokumen
        $b = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where `status` = 'berlaku' AND is_approved = 1"));
        $tb = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where `status` = 'tidak berlaku' AND is_approved = 1"));
        $mr = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where `status` = 'masa review' AND is_approved = 1"));

        // jenis dokumen
        $sk = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'Safekeeping' AND is_approved = 1"));
        $kpd = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'KPD (Kontrak Pengelolaan Dana)' AND is_approved = 1"));
        $rd = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'Reksadana' AND is_approved = 1"));
        $eba = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'EBA (Efek Beragun Aset)' AND is_approved = 1"));
        $om = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'Ops memo' AND is_approved = 1"));
        $sa = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'Selling Agent' AND is_approved = 1"));
        $sla = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where jenis_perjanjian = 'SLA (Service Level Agreement)' AND is_approved = 1"));
        ?>
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
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome to Custodian Dashboard!</h3>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
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
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">236</h2>
                                        <!-- <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span> -->
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-success"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">18,306</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Approved Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-danger"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">1538</h2>
                                        <!-- <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span> -->
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rejected Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-warning"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">864</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Canceled Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-info"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- *************************************************************** -->
                <!-- End First Cards -->
                <!-- *************************************************************** -->
                <!-- *************************************************************** -->
                <!-- Start Sales Charts Section -->
                <!-- *************************************************************** -->
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Documents By Status</h4>
                                <div>
                                    <canvas id="radar-chart" height="440"></canvas>
                                </div>
                                <!-- <ul class="list-style-none mb-0">
                                    <li>
                                        <i class="fas fa-circle text-success font-10 mr-2"></i>
                                        <span class="text-muted">Berlaku</span>
                                        <span class="text-dark float-right font-weight-medium"><?= $b[0]; ?></span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                        <span class="text-muted">Tidak Berlaku</span>
                                        <span class="text-dark float-right font-weight-medium"><?= $tb[0]; ?></span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-warning font-10 mr-2"></i>
                                        <span class="text-muted">Masa Review</span>
                                        <span class="text-dark float-right font-weight-medium"><?= $mr[0]; ?></span>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Net Income</h4>
                                <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                <ul class="list-inline text-center mt-5 mb-2">
                                    <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Documents by Type</h4>
                                <div>
                                    <canvas id="pie-chart" height="425"></canvas>
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
                All Rights Reserved by Custodian. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
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


    <?php include "partials/script.php" ?>
    <script src="../src/assets/libs/chart.js/dist/Chart.min.js"></script>
    <script>
        var xValues = ["Berlaku", "Tidak Berlaku", "Masa Review"];
        var yValues = [<?= $b[0]; ?>, <?= $tb[0]; ?>, <?= $mr[0]; ?>];
        var barColors = [
            "#22ca80",
            "#ff4f70",
            "#fdc16a"
        ];

        new Chart("radar-chart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            // options: {
            //     title: {
            //         display: true,
            //         text: "World Wide Wine Production 2018"
            //     }
            // }
        });
        var aValues = ["Safekeeping", "KPD", "Reksadana", "EBA", "Ops Memo", "SLA", "Selling Agent"];
        var bValues = [<?= $sk[0]; ?>, <?= $kpd[0]; ?>, <?= $rd[0]; ?>, <?= $eba[0]; ?>, <?= $om[0]; ?>, <?= $sla[0]; ?>, <?= $sa[0]; ?>];
        var pieColors = [
            "#fb8c00",
            "#01caf1",
            "#DB7093",
            "#20c997",
            "#6610f2",
            "#1c2d41",
            "#DC143C"
        ];

        new Chart("pie-chart", {
            type: "pie",
            data: {
                labels: aValues,
                datasets: [{
                    backgroundColor: pieColors,
                    data: bValues
                }]
            },
            // options: {
            //     title: {
            //         display: true,
            //         text: "World Wide Wine Production 2018"
            //     }
            // }
        });
    </script>
</body>

</html>