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
    <title>User Management</title>
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
        <?php $active = 'a' ?>
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
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $id = $_GET["id"];
                                $data = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
                                $row = mysqli_fetch_row($data);
                                ?>
                                <h4 class="card-title">Edit User</h4>
                                <hr>
                                <form action="functions/editUser.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $row[0]; ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="" name="name" value="<?= $row[1]; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <!-- <input type="hidden" class="form-control" placeholder="" name="oldusername" value="<?= $row[2]; ?>" required> -->
                                        <input type="text" class="form-control" placeholder="" name="username" value="<?= $row[2]; ?>" disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="role" required>
                                            <option disabled selected value>Choose...</option>
                                            <option value="Maker">Maker</option>
                                            <option value="Approver">Approver</option>
                                            <option value="Compliance">Compliance</option>
                                            <option value="Operation">Operation</option>
                                        </select>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" name="editrole" class="btn btn-info">Submit</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status Account</h4>
                                <hr>
                                <p>Account is
                                    <?php
                                    if ($row[6] == 1) {
                                        echo "<span class='text-success'>Active
                                        </span>";
                                    } elseif ($row[6] == 2) {
                                        echo "<span class='text-warning'>Locked
                                        </span>";
                                    } else {
                                        echo "<span class='text-danger'>Disabled
                                        </span>";
                                    }
                                    ?></p>
                                <a href="functions/editUser.php?activateuser=<?= $row[0]; ?>" class="btn btn-success <?= ($row[6] == 0 || $row[6] == 2) ? '' : 'disabled'; ?>">Activate</a>
                                <a href="functions/editUser.php?disableuser=<?= $row[0]; ?>" class="btn btn-danger <?= ($row[6] == 1 || $row[6] == 2) ? '' : 'disabled'; ?>">Disable</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Status Account</h4>
                                <hr>
                                <p>User Password
                                    <?php
                                    if ($row[5] == 1) {
                                        echo "<span class='text-warning'>has been Reseted</span></p>";
                                    } else {
                                        echo "<span class='text-success'>is Safe</span></p>";
                                    }
                                    ?>
                                    <a href="functions/editUser.php?resetpass=<?= $row[0]; ?>" class="btn btn-warning <?= ($row[5] == 1) ? 'disabled' : ''; ?>">Reset Password</a>
                                <p class="text-muted font-14 mt-2 mb-0">If the password has been reset, the user must login with this password 'custodithebest'</p>
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