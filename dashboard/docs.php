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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Hello <?= $_SESSION['name']; ?>!</h3>
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
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#top-modal"><i class="fa fa-filter"></i> Filters</button>
                                    <a href="?" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</a>
                                </div>

                                <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="topModalLabel"><strong>Filters</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="">
                                                    <table style="width:100%;">
                                                        <tr>
                                                            <td width="70px" valign="top">Jenis</td>
                                                            <td valign="top">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'Ops memo'" id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1">Ops memo</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'Reksadana'" id="customCheck2">
                                                                    <label class="custom-control-label" for="customCheck2">Reksadana</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'Safekeeping'" id="customCheck3">
                                                                    <label class="custom-control-label" for="customCheck3">Safekeeping</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'Selling Agent'" id="customCheck4">
                                                                    <label class="custom-control-label" for="customCheck4">Selling Agent</label>
                                                                </div>
                                                                <!-- <label><input type="checkbox" name="type[]" value="'Selling Agent'">Selling Agent</label><br>
                                                                <label><input type="checkbox" name="type[]" value="'Reksadana'">Reksadana</label><br> -->
                                                                <!-- <label><input type="checkbox" name="type[]" value="'KPD (Kontrak Pengelolaan Dana)'">KPD (Kontrak Pengelolaan Dana)</label><br>
                                                                <label><input type="checkbox" name="type[]" value="'SLA (Service Level Agreement)'">SLA (Service Level Agreement)</label><br> -->
                                                            </td>
                                                            <td valign="top">
                                                                <!-- <label><input type="checkbox" name="type[]" value="'Selling Agent'">Selling Agent</label><br>
                                                                <label><input type="checkbox" name="type[]" value="'Reksadana'">Reksadana</label><br>
                                                                <label><input type="checkbox" name="type[]" value="'KPD (Kontrak Pengelolaan Dana)'">KPD (Kontrak Pengelolaan Dana)</label><br>
                                                                <label><input type="checkbox" name="type[]" value="'SLA (Service Level Agreement)'">SLA (Service Level Agreement)</label><br> -->
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'>EBA (Efek Beragun Aset)'" id="customCheck5">
                                                                    <label class="custom-control-label" for="customCheck5">EBA (Efek Beragun Aset)</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'SLA (Service Level Agreement)'" id="customCheck6">
                                                                    <label class="custom-control-label" for="customCheck6">SLA (Service Level Agreement)</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'KPD (Kontrak Pengelolaan Dana)'" id="customCheck7">
                                                                    <label class="custom-control-label" for="customCheck7">KPD (Kontrak Pengelolaan Dana)</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                    <table style="width:100%;">
                                                        <tr>
                                                            <td width="70px" valign="top">Status</td>
                                                            <td valign="top">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="status[]" value="'Berlaku'" id="customCheck11">
                                                                    <label class="custom-control-label" for="customCheck11">Berlaku</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="status[]" value="'Tidak Berlaku'" id="customCheck12">
                                                                    <label class="custom-control-label" for="customCheck12">Tidak Berlaku</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="status[]" value="'Masa Review'" id="customCheck13">
                                                                    <label class="custom-control-label" for="customCheck13">Masa Review</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                    <table style="width:100%;">
                                                        <tr>
                                                            <td width="70px" valign="top">Tanggal</td>
                                                            <td>
                                                                <input type="date" class="w-100" name="firstdate">
                                                                <small id="name1" class="badge badge-default badge-secondary form-text text-white float-left">Start Date</small>
                                                                <!-- <label><input type="date" name="lastdate"> Akhir</label><br> -->
                                                            </td>
                                                            <td>
                                                                <!-- <label><input type="date" name="firstdate"> Awal</label><br> -->
                                                                <input type="date" class="w-100" name="lastdate">
                                                                <small id="name1" class="badge badge-default badge-secondary form-text text-white float-left">End Date</small>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-light">Reset</button>
                                                <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
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
                                            if (isset($_POST['simpan'])) {
                                                // foreach ($_POST['hobi'] as $value) {
                                                //     echo $value . ',';
                                                // }
                                                $and = 'is_approved = 1';
                                                if (!empty($_POST['status'])) {
                                                    $filter = implode(",", $_POST['status']);
                                                    $and .= " AND `status` IN ($filter)";
                                                }
                                                if (!empty($_POST['type'])) {
                                                    $filter2 = implode(",", $_POST['type']);
                                                    $and .= " AND jenis_perjanjian IN ($filter2)";
                                                }
                                                if (!empty($_POST['firstdate']) && !empty($_POST['lastdate'])) {
                                                    $fd = $_POST['firstdate'];
                                                    $ld = $_POST['lastdate'];
                                                    // echo $_POST['lastdate'];
                                                    // echo $_POST['firstdate'];
                                                    $and .= " AND tanggal_perjanjian BETWEEN '$fd' AND '$ld'";
                                                }
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE " . $and);
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE is_approved = 1");
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