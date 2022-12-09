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
    <title>Edit Document</title>
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
            <div class="page-breadcrumb">
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
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="upload.php" class="btn btn-primary">Upload Dokumen + </a>
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
                                <h4 class="card-title">Perbarui Dokumen</h4>
                                <hr>
                                <?php
                                $id = $_GET["id"];
                                $data = mysqli_query($conn, "SELECT * FROM docs WHERE id_dokumen = '$id'");
                                $row = mysqli_fetch_row($data);
                                ?>
                                <form action="functions/updateDoc.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control" name="id_dokumen" value="<?= $row[0]; ?>" required>
                                    <div class="form-group">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Nama Dokumen</label>
                                        <input type="text" class="form-control" name="nama_dokumen" value="<?= $row[1]; ?>" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Pilih Jenis Perjanjian</label>
                                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="jenis_perjanjian" required>
                                                    <!-- <option disabled selected value>...</option> -->
                                                    <option value="Safekeeping" <?= ($row[4] == 'Safekeeping') ? 'selected' : ''  ?>>Safekeeping</option>
                                                    <option value="KPD (Kontrak Pengelolaan Dana)" <?= ($row[4] == 'KPD (Kontrak Pengelolaan Dana)') ? 'selected' : ''  ?>>KPD (Kontrak Pengelolaan Dana)</option>
                                                    <option value="Reksadana" <?= ($row[4] == 'Reksadana') ? 'selected' : ''  ?>>Reksadana</option>
                                                    <option value="EBA (Efek Beragun Aset)" <?= ($row[4] == 'EBA (Efek Beragun Aset)') ? 'selected' : ''  ?>>EBA (Efek Beragun Aset)</option>
                                                    <option value="Ops memo" <?= ($row[4] == 'Ops memo') ? 'selected' : ''  ?>>Ops memo</option>
                                                    <option value="Selling Agent" <?= ($row[4] == 'Selling Agent') ? 'selected' : ''  ?>>Selling Agent</option>
                                                    <option value="SLA (Service Level Agreement)" <?= ($row[4] == 'SLA (Service Level Agreement)') ? 'selected' : ''  ?>>SLA (Service Level Agreement)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nasabah</label>
                                                <input type="text" class="form-control" name="nasabah" value="<?= $row[3]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nomor Perjanjian</label>
                                                <input type="text" class="form-control" name="nomor_perjanjian" value="<?= $row[5]; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Nomor Perjanjian Terkait</label>
                                                <input type="text" class="form-control" name="nomor_perjanjian_terkait" value="<?= $row[6]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tanggal Perjanjian</label>
                                                <input type="date" class="form-control" name="tanggal_perjanjian" value="<?= $row[7]; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Tanggal Berakhir</label>
                                                <input type="date" class="form-control" name="tanggal_berakhir" value="<?= $row[8]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Upload Dokumen</label>
                                                <input class="form-control" name="dokumen" type="file" id="formFile" onchange="preview()">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="mr-sm-2" for="inlineFormCustomSelect">Pilih Approver</label>
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
                                    <!-- <button type="reset" class="btn waves-effect px-4 waves-light btn-outline-secondary">Reset</button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <embed src="docs/<?= $row[2]; ?>" height="400" id="preview">
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