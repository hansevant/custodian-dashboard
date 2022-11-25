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
    <title>Account Management</title>
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
        <?php $active = 'b' ?>
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
                <?php
                $id = $_SESSION["id"];
                $data = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                $row = mysqli_fetch_row($data);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title d-inline">Change Password</h4>
                                <?php if ($row[5] == 1) { ?>
                                    <small class="text-danger">Please update your password first!</small>
                                <?php } ?>
                                <hr>
                                <form action="functions/account.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $row[0]; ?>">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" placeholder="" name="oldpassword" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" placeholder="" name="newpassword" required>
                                        <small id="textHelp" class="form-text text-muted">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. <br> For Example : <b>Kustodian100!</b> </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Re-enter New Password</label>
                                        <input type="password" class="form-control" placeholder="" name="newpassword2" required>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-info" name="submit_cp">Submit</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                    </div>
                                </form>
                                <?php if (isset($_GET['success'])) { ?>
                                    <div class="mt-3 alert alert-success alert-dismissible border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Success Changed the password</strong>
                                    </div>
                                <?php }
                                if (isset($_GET['failed'])) { ?>
                                    <div class="mt-3 alert alert-danger alert-dismissible border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Failed to Change the password</strong>
                                    </div>
                                <?php } ?>
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
</body>

</html>