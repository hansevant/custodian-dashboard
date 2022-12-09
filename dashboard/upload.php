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
    <?php include "../partials/head.php"; ?>
    <title>Upload Dokumen</title>
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
            <!-- <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning <?= $_SESSION['name'];; ?>!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="../logout.php">keluar</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="upload.php" class="btn btn-primary">Upload Dokumen + </a>
                        </div>
                    </div>
                </div>
            </div> -->
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Input Dokumen</h4>
                                <hr>
                                <form action="functions/uploadDoc.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Nama Dokumen <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" autofocus name="nama_dokumen" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Pilih Jenis Perjanjian <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="jenis_perjanjian" required>
                                                    <option disabled selected value>...</option>
                                                    <option value="Safekeeping">Safekeeping</option>
                                                    <option value="KPD (Kontrak Pengelolaan Dana)">KPD (Kontrak Pengelolaan Dana)</option>
                                                    <option value="Reksadana">Reksadana</option>
                                                    <option value="EBA (Efek Beragun Aset)">EBA (Efek Beragun Aset)</option>
                                                    <option value="Ops Memo">Ops Memo</option>
                                                    <option value="Selling Agent">Selling Agent</option>
                                                    <option value="SLA (Service Level Agreement)">SLA (Service Level Agreement)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nasabah <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nasabah" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nomor Perjanjian <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nomor_perjanjian" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nomor Perjanjian Terkait</label>
                                                <input type="text" class="form-control" name="nomor_perjanjian_terkait">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tanggal Perjanjian <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_perjanjian" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tanggal Berakhir <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_berakhir" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Upload Dokumen <span class="text-danger">*</span></label>
                                                <input class="form-control" type="file" id="formFile" name="dokumen" onchange="preview()" required>
                                                <small id="formFile" class="form-text text-muted">Hanya menerima tipe file PDF</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Approver <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="approver" required>
                                                    <option disabled selected value>Choose..</option>
                                                    <?php
                                                    $users = mysqli_query($conn, "SELECT * FROM users WHERE role = 'Approver' AND is_approved = 1");
                                                    while ($user = mysqli_fetch_array($users)) {
                                                    ?>
                                                        <option value="<?= $user['id']; ?>"><?= $user['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn waves-effect px-4 waves-light btn-primary">Submit</button>
                                    <button type="reset" class="btn waves-effect px-4 waves-light btn-outline-secondary">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <embed src="../partials/pdf.pdf" height="400" id="preview">
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