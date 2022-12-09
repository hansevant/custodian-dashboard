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
    <link href="../src/assets/extra-libs/datatables.net/css/buttons.dataTables.min.css" rel="stylesheet">
    <?php include "../partials/head.php"; ?>
    <title>Documents</title>
    <style>
        .dt-button.red {
            color: red;
            background: none;
            margin-bottom: 10px;
        }

        .dt-button.green {
            color: limegreen;
            background: none;
            margin-bottom: 10px;
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
                                <div class="btn-group float-left">
                                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Custodian Documents</h3>
                                </div>

                                <!-- <h4 class="card-title float-left">Custodian Documents</h4> -->
                                <!-- Modal Filter -->

                                <div class="btn-group float-right">
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#top-modal"><i class="fa fa-filter"></i> Filters</button>
                                    <!-- <a href="?" class="btn btn-outline-secondary"><i class="fas fa-undo"></i> Reset</a> -->
                                    <?php if ($_SESSION['role'] == 'Maker') { ?>
                                        <a href="upload.php" class="ml-2 btn btn-primary">+ Add Document </a>
                                    <?php } ?>
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
                                                    <table>
                                                        <tr>
                                                            <td width="70px" valign="top">Jenis</td>
                                                            <td valign="top">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="type[]" value="'Ops Memo'" id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1">Ops Memo</label>
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
                                                            <td valign="top" style="padding-left: 8px;">
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
                                                    <table>
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
                                                    <table>
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
                                    <table width="1600" style="color:#333;font-size: 14px;" id="myTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Dokumen</th>
                                                <th class="text-center">Nasabah</th>
                                                <th class="text-center">Jenis Perjanjian</th>
                                                <th class="text-center">Nomor Perjanjian</th>
                                                <th class="text-center">Tanggal Perjanjian</th>
                                                <th class="text-center">Tanggal Berakhir</th>
                                                <th class="text-center">SLA</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($_POST['simpan'])) {
                                                // fitur filter dokumen 
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
                                                    $and .= " AND tanggal_perjanjian BETWEEN '$fd' AND '$ld'";
                                                }
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE " . $and);
                                            } elseif (isset($_GET['jan'])) {
                                                $jan = $_GET['jan'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$jan%' AND is_approved = 1");
                                            } elseif (isset($_GET['feb'])) {
                                                $feb = $_GET['feb'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$feb%' AND is_approved = 1");
                                            } elseif (isset($_GET['mar'])) {
                                                $mar = $_GET['mar'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$mar%' AND is_approved = 1");
                                            } elseif (isset($_GET['apr'])) {
                                                $apr = $_GET['apr'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$apr%' AND is_approved = 1");
                                            } elseif (isset($_GET['may'])) {
                                                $may = $_GET['may'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$may%' AND is_approved = 1");
                                            } elseif (isset($_GET['jun'])) {
                                                $jun = $_GET['jun'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$jun%' AND is_approved = 1");
                                            } elseif (isset($_GET['jul'])) {
                                                $jul = $_GET['jul'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$jul%' AND is_approved = 1");
                                            } elseif (isset($_GET['aug'])) {
                                                $aug = $_GET['aug'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$aug%' AND is_approved = 1");
                                            } elseif (isset($_GET['sep'])) {
                                                $sep = $_GET['sep'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$sep%' AND is_approved = 1");
                                            } elseif (isset($_GET['oct'])) {
                                                $oct = $_GET['oct'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$oct%' AND is_approved = 1");
                                            } elseif (isset($_GET['nov'])) {
                                                $nov = $_GET['nov'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$nov%' AND is_approved = 1");
                                            } elseif (isset($_GET['des'])) {
                                                $des = $_GET['des'];
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE tanggal_perjanjian LIKE '%$des%' AND is_approved = 1");
                                            } elseif (isset($_GET['kpd'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'KPD (Kontrak Pengelolaan Dana)' AND is_approved = 1");
                                            } elseif (isset($_GET['eba'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'EBA (Efek Beragun Aset)' AND is_approved = 1");
                                            } elseif (isset($_GET['sla'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'SLA (Service Level Agreement)' AND is_approved = 1");
                                            } elseif (isset($_GET['opsmemo'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'Ops memo' AND is_approved = 1");
                                            } elseif (isset($_GET['reksadana'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'Reksadana' AND is_approved = 1");
                                            } elseif (isset($_GET['safekeeping'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'Safekeeping' AND is_approved = 1");
                                            } elseif (isset($_GET['sellingagent'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE jenis_perjanjian = 'Selling Agent' AND is_approved = 1");
                                            } elseif (isset($_GET['berlaku'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE `status` = 'Berlaku' AND is_approved = 1");
                                            } elseif (isset($_GET['tidakberlaku'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE `status` = 'Tidak Berlaku' AND is_approved = 1");
                                            } elseif (isset($_GET['masareview'])) {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE `status` = 'Masa Review' AND is_approved = 1");
                                            } else {
                                                $sql = mysqli_query($conn, "SELECT * FROM docs WHERE is_approved = 1");
                                            }

                                            $n = 1;
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $now = gmdate("Y-m-d", time());
                                                $remaining = strtotime($data[8]) - time();
                                                $days_remaining = floor($remaining / 86400);
                                                $hours_remaining = floor(($remaining % 86400) / 3600);

                                                $tp = date("d-m-Y", strtotime($data[7]));
                                                $tb =  date("d-m-Y", strtotime($data[8]));
                                            ?>

                                                <tr>
                                                    <td style="width:200px;"><a href="doc.php?id_dokumen=<?= $data[0] ?>"><?= $data[1]; ?></a></td>
                                                    <td style="width:200px;"><?= $data[3]; ?></td>
                                                    <td style="white-space: nowrap;"><?= $data[4]; ?></td>
                                                    <td style="white-space: nowrap;"><?= $data[5]; ?></td>
                                                    <td style="width:150px"><?= $tp; ?></td>
                                                    <td style="width:150px"><?= $tb; ?></td>
                                                    <td style="white-space: nowrap;">
                                                        <?php
                                                        if ($data[10] == 'Masa Review') {
                                                            echo "sisa waktu : $days_remaining hari dan $hours_remaining jam lagi<br>";
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="white-space: nowrap;"><?= $data[10]; ?></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Dokumen</th>
                                                <th class="text-center">Nasabah</th>
                                                <th class="text-center">Jenis Perjanjian</th>
                                                <th class="text-center">Nomor Perjanjian</th>
                                                <th class="text-center">Tanggal Perjanjian</th>
                                                <th class="text-center">Tanggal Berakhir</th>
                                                <th class="text-center">SLA</th>
                                                <th class="text-center">Status</th>
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
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Report Excel ',
                        className: 'green',
                        title: 'Summary'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> Report PDF ',
                        className: 'red',
                        title: 'Summary'
                    },
                ]
            });
        });
    </script>
    <script src="../src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../src/assets/extra-libs/datatables.net/js/dataTables.buttons.min.js"></script>
    <script src="../src/assets/extra-libs/datatables.net/js/jszip.min.js"></script>
    <script src="../src/assets/extra-libs/datatables.net/js/pdfmake.min.js"></script>
    <script src="../src/assets/extra-libs/datatables.net/js/vfs_fonts.js"></script>
    <script src="../src/assets/extra-libs/datatables.net/js/buttons.html5.min.js"></script>
</body>

</html>