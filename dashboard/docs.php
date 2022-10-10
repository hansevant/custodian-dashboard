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
    <!-- This page plugin datatables CSS -->
    <link href="../src/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <?php include "partials/head.php"; ?>
    <title>Dokumen</title>
    <style>
        ul.ks-cboxtags {
            list-style: none;
            padding: 20px;
        }

        ul.ks-cboxtags li {
            display: inline;
        }

        ul.ks-cboxtags li label {
            display: inline-block;
            background-color: rgba(255, 255, 255, .9);
            border: 2px solid rgba(139, 139, 139, .3);
            color: #adadad;
            border-radius: 25px;
            white-space: nowrap;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;
        }

        ul.ks-cboxtags li label {
            padding: 8px 12px;
            cursor: pointer;
        }

        ul.ks-cboxtags li label::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px;
            padding: 2px 6px 2px 2px;
            content: "\f067";
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="checkbox"]:checked+label::before {
            content: "\f00c";
            transform: rotate(-360deg);
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="checkbox"]:checked+label {
            border: 2px solid #1bdbf8;
            background-color: #12bbd4;
            color: #fff;
            transition: all .2s;
        }

        ul.ks-cboxtags li input[type="checkbox"] {
            display: absolute;
        }

        ul.ks-cboxtags li input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        ul.ks-cboxtags li input[type="checkbox"]:focus+label {
            border: 2px solid #e9a1ff;
        }
    </style>
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
        <?php $active = 'y' ?>
        <?php include "partials/sidebar.php" ?>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning <?= $_SESSION['name']; ?>!</h3>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <?php if ($_SESSION['role'] == 'RM') { ?>
                            <div class="customize-input float-right">
                                <a href="upload.php" class="btn btn-primary">Add Document + </a>
                            </div>
                        <?php } ?>
                    </div>
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
                                <h4 class="card-title float-left">Custodian Documents</h4>

                                <!-- Modal Filter -->

                                <div class="btn-group float-right">
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#right-modal">Filter</button>
                                </div>

                                <div id="right-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-sm justify-content-start modal-right">
                                        <div class="modal-content pr-4 border-0">
                                            <div class="modal-header border-0">
                                                <h4 class="modal-title" id="myLargeModalLabel">Filter</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <p>Filter By Agreement Date</p>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control">
                                                        <small id="textHelp" class="form-text text-muted">From</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="date" class="form-control">
                                                        <small id="textHelp" class="form-text text-muted">To</small>
                                                    </div>
                                                    <hr>
                                                    <p>Filter By Type of Agreement</p>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Ops memo</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Reksadana</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                        <label class="custom-control-label" for="customCheck3">Safekeeping</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                        <label class="custom-control-label" for="customCheck4">Selling Agentu</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                        <label class="custom-control-label" for="customCheck5">EBA (Efek Beragun Aset)</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                        <label class="custom-control-label" for="customCheck6">SLA (Service Level Agreement)</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                        <label class="custom-control-label" for="customCheck7">KPD (Kontrak Pengelolaan Dana)</label>
                                                    </div>
                                                    <hr>
                                                    <p>Filter By Status</p>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                        <label class="custom-control-label" for="customCheck11">Berlaku</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                        <label class="custom-control-label" for="customCheck12">Tidak Berlaku</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                        <label class="custom-control-label" for="customCheck13">Masa Review</label>
                                                    </div>
                                                    <hr>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                        <button type="reset" class="btn btn-dark">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <hr class="mt-5">
                                <div class="table-responsive">
                                    <table style="font-size: 14px;" id="myTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Dokumen</th>
                                                <th>Nasabah</th>
                                                <th>Jenis Perjanjian</th>
                                                <th>Nomor Perjanjian</th>
                                                <th>Tanggal Perjanjian</th>
                                                <th>Tanggal Berakhir</th>
                                                <th>SLA</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            if (!$i) {

                                                $sql = mysqli_query($conn, "SELECT * FROM docs where `status` = 'berlaku'");
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs where is_approved = 1");
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
                                                    <td><?= $data[5]; ?></td>
                                                    <td><?= $data[7]; ?></td>
                                                    <td><?= $data[8]; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($data[10] == 'masa review') {
                                                            echo "sisa waktu : $days_remaining hari dan $hours_remaining jam lagi<br>";
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $data[10]; ?></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Dokumen</th>
                                                <th>Nasabah</th>
                                                <th>Jenis Perjanjian</th>
                                                <th>Nomor Perjanjian</th>
                                                <th>Tanggal Perjanjian</th>
                                                <th>Tanggal Berakhir</th>
                                                <th>SLA</th>
                                                <th>Status</th>
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

    <!-- Data Table -->
    <?php include "partials/script.php" ?>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script src="../src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- <script src="../src/dist/js/pages/datatable/datatable-basic.init.js"></script> -->
</body>

</html>