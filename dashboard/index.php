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
        <?php include "../partials/navbar.php" ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $active = 'x' ?>
        <?php include "../partials/sidebar.php" ?>
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

        // total dokumen
        $tds = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs "));
        $ads = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where is_approved = 1"));
        $pds = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where is_approved = 0"));
        $rds = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where is_approved = 2"));
        $cds = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where is_approved = 3"));

        //dokumen pertahun
        $d0 = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%2020%' AND is_approved = 1"));
        $d1 = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%2021%' AND is_approved = 1"));
        $d2 = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%2022%' AND is_approved = 1"));
        $d3 = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%2023%' AND is_approved = 1"));

        // dokumen perbulan
        // tahun 2022

        $currentyear = gmdate("Y", time());
        $docperyear = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$currentyear%' AND is_approved = 1"));
        $jan = $currentyear . '-01';
        $feb = $currentyear . '-02';
        $mar = $currentyear . '-03';
        $apr = $currentyear . '-04';
        $may = $currentyear . '-05';
        $jun = $currentyear . '-06';
        $jul = $currentyear . '-07';
        $aug = $currentyear . '-08';
        $sep = $currentyear . '-09';
        $oct = $currentyear . '-10';
        $nov = $currentyear . '-11';
        $des = $currentyear . '-12';

        $docperjan = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$jan%' AND is_approved = 1"));
        $docperfeb = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$feb%' AND is_approved = 1"));
        $docpermar = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$mar%' AND is_approved = 1"));
        $docperapr = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$apr%' AND is_approved = 1"));
        $docpermay = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$may%' AND is_approved = 1"));
        $docperjun = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$jun%' AND is_approved = 1"));
        $docperjul = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$jul%' AND is_approved = 1"));
        $docperaug = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$aug%' AND is_approved = 1"));
        $docpersep = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$sep%' AND is_approved = 1"));
        $docperoct = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$oct%' AND is_approved = 1"));
        $docpernov = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$nov%' AND is_approved = 1"));
        $docperdes = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM docs where tanggal_perjanjian LIKE '%$des%' AND is_approved = 1"));
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
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><?= $ads[0]; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Approved Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-success"><i data-feather="check-circle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?= $pds[0]; ?></h2>
                                        <!-- <span class="badge bg-danger font-14 mr-1 text-white font-weight-medium badge-pill ml-2 text-secondary d-md-none d-lg-block">-18.33%</span> -->
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pending Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-warning"><i data-feather="alert-triangle"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?= $rds[0]; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rejected Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-danger"><i data-feather="x-octagon"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?= $cds[0]; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Canceled Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-dark"><i data-feather="trash-2"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?= $tds[0]; ?></h2>
                                        <!-- <span class="badge bg-primary font-14 mr-1 text-white font-weight-medium badge-pill ml-2 text-secondary d-lg-block d-md-none">+18.33%</span> -->
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Documents</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-info"><i data-feather="file-text"></i></span>
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
                <div class="row justify-content-around">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="">Number of Documents per Month in <?= $currentyear; ?></h3>
                                <hr>
                                <div class="text-center ">
                                    <ul class="list-inline text-center">
                                        <li class=" list-inline-item h4 text-muted font-italic">Total Documents in <?= $currentyear; ?> are <b><?= $docperyear[0]; ?></b></li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="bar-chart" style="height:100%;max-height:400px"></canvas>
                                    </div>
                                </div>
                                <div class="mt-1 d-flex d-sm-block d-md-flex justify-content-between">
                                    <a href=" docs.php?jan=<?= $jan; ?>" class="ml-3 font-14 text-secondary">
                                        <i style="color:rgba(255, 99, 132, 1)" class="fa fa-square font-12"></i>
                                        Jan
                                    </a> <br>
                                    <a href="docs.php?feb=<?= $feb; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(255, 159, 64)" class="fa fa-square font-12"></i>
                                        Feb
                                    </a> <br>
                                    <a href="docs.php?mar=<?= $mar; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(255, 205, 86)" class="fa fa-square font-12"></i>
                                        Mar
                                    </a> <br>
                                    <a href="docs.php?apr=<?= $apr; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(230, 230, 11)" class="fa fa-square font-12"></i>
                                        Apr
                                    </a> <br>
                                    <a href="docs.php?may=<?= $may; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(157, 230, 11)" class="fa fa-square font-12"></i>
                                        May
                                    </a> <br>
                                    <a href="docs.php?jun=<?= $jun; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(37, 230, 11)" class="fa fa-square font-12"></i>
                                        Jun
                                    </a> <br>
                                    <a href="docs.php?jul=<?= $jul; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(11, 230, 102)" class="fa fa-square font-12"></i>
                                        Jul
                                    </a> <br>
                                    <a href="docs.php?aug=<?= $aug; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(11, 230, 219)" class="fa fa-square font-12"></i>
                                        Aug
                                    </a> <br>
                                    <a href="docs.php?sep=<?= $sep; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(75, 192, 192)" class="fa fa-square font-12"></i>
                                        Sep
                                    </a> <br>
                                    <a href="docs.php?oct=<?= $oct; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(54, 162, 235)" class="fa fa-square font-12"></i>
                                        Oct
                                    </a> <br>
                                    <a href="docs.php?nov=<?= $nov; ?>" class="font-14 text-secondary">
                                        <i style="color:rgb(153, 102, 255)" class="fa fa-square font-12"></i>
                                        Nov
                                    </a> <br>
                                    <a href="docs.php?des=<?= $des; ?>" class="mr-2 font-14 text-secondary">
                                        <i style="color:rgb(230, 11, 204)" class="fa fa-square font-12"></i>
                                        Dec
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card" style="height: 444px">
                            <div class="card-body">
                                <h4 class="text-center font-font-weight-medium">Documents By Status</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="radar-chart" style="height:100%;max-height:250px"></canvas>
                                    </div>
                                    <div class="col-md-12 mt-3 text-center">
                                        <a href="docs.php?berlaku=1" class=" font-14 text-secondary">
                                            <i style="color:#22ca80" class="fa fa-square font-14"></i>
                                            Berlaku : <?= $b[0]; ?>
                                        </a>
                                        <a href="docs.php?masareview=1" class="mx-3 font-14 text-secondary">
                                            <i style="color:#fdc16a" class="fa fa-square font-14"></i>
                                            Masa Review : <?= $mr[0] ?>
                                        </a>
                                        <a href="docs.php?tidakberlaku=1" class="font-14 text-secondary">
                                            <i style="color:#ff4f70" class="fa fa-square font-14"></i>
                                            Tidak Berlaku : <?= $tb[0]; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card" style="height: 444px">
                            <div class="card-body">
                                <h4 class="text-center">Documents By Type</h4>
                                <hr>
                                <div class="row">

                                    <div class="col-md-12">
                                        <canvas id="pie-chart" style="height:100%;max-height:250px"></canvas>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-3">
                                                <a href="docs.php?kpd=1" class="font-14 text-secondary">
                                                    <i style="color:#db3e32" class="fa fa-square font-14"></i>
                                                    KPD : <?= $kpd[0]; ?><br>
                                                </a>
                                                <a href="docs.php?eba=1" class="font-14 text-secondary">
                                                    <i style="color:#384d82" class="fa fa-square font-14"></i>
                                                    EBA : <?= $eba[0]; ?><br>
                                                </a>
                                                <a href="docs.php?sla=1" class="font-14 text-secondary">
                                                    <i style="color:#2497ab" class="fa fa-square font-14"></i>
                                                    SLA : <?= $sla[0]; ?><br>
                                                </a>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <a href="docs.php?opsmemo=1" class=" font-14 text-secondary">
                                                    <i style="color:#ccac78" class="fa fa-square font-14"></i>
                                                    Ops Memo : <?= $om[0]; ?><br>
                                                </a>
                                                <a href="docs.php?reksadana=1" class="font-14 text-secondary">
                                                    <i style="color:#427840" class="fa fa-square font-14"></i>
                                                    Reksadana : <?= $rd[0]; ?><br>
                                                </a>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <a href="docs.php?safekeeping=1" class="font-14 text-secondary">
                                                    <i style="color:#d48787" class="fa fa-square font-14"></i>
                                                    Safekeeping : <?= $sk[0]; ?><br>
                                                </a>
                                                <a href="docs.php?sellingagent=1>" class=" font-14 text-secondary">
                                                    <i style="color:#999797" class="fa fa-square font-14"></i>
                                                    Selling Agent : <?= $sa[0]; ?><br>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

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
    <script src="../src/assets/libs/chart.js/dist/Chart.min.js"></script>
    <script src="../src/assets/libs/chart.js/dist/chartjs-plugin-datalabels.min.js"></script>
    <script>
        // const ctx = document.getElementById('myChart');
        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"];
        let barColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(230, 230, 11, 0.2)',
            'rgba(157, 230, 11, 0.2)',
            'rgba(37, 230, 11, 0.2)',
            'rgba(11, 230, 102, 0.2)',
            'rgba(11, 230, 219, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(230, 11, 204, 0.2)'
        ];
        let borderColors = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(230, 230, 11)',
            'rgb(157, 230, 11)',
            'rgb(37, 230, 11)',
            'rgb(11, 230, 102)',
            'rgb(11, 230, 219)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(230, 11, 204)'
        ]

        const hidezero = (value) => {
            if (value > 0) {
                return value;
            } else {
                value = ''
                return value
            }
        }

        const convertPercentage = (value, ctx) => {
            if (value > 0) {
                let sum = 0;
                let dataArr = ctx.chart.data.datasets[0].data;
                dataArr.map(data => {
                    sum += data;
                });
                let percentage = Math.round((value / sum) * 100) + '%';
                return percentage;
            } else {
                value = ''
                return value
            }
        }

        const option = {
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    font: {
                        size: 15,
                    },
                    formatter: hidezero
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        display: false,
                    }
                },
                x: {
                    ticks: {
                        display: false,
                    }
                },
            },
        }

        new Chart("bar-chart", {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Total ',
                    data: [
                        <?= $docperjan[0]; ?>,
                        <?= $docperfeb[0]; ?>,
                        <?= $docpermar[0]; ?>,
                        <?= $docperapr[0]; ?>,
                        <?= $docpermay[0]; ?>,
                        <?= $docperjun[0]; ?>,
                        <?= $docperjul[0]; ?>,
                        <?= $docperaug[0]; ?>,
                        <?= $docpersep[0]; ?>,
                        <?= $docperoct[0]; ?>,
                        <?= $docpernov[0]; ?>,
                        <?= $docperdes[0]; ?>,
                    ],
                    backgroundColor: barColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: option
        });

        // new Chart("bar-chart2", {
        //     type: 'bar',
        //     data: {
        //         labels: months,
        //         datasets: [{
        //             label: 'Total ',
        //             data: [55, 49, 44, 24, 14, 25, 19, 34, 54, 44, 51, 10],
        //             backgroundColor: barColors,
        //             borderColor: borderColors,
        //             borderWidth: 1
        //         }]
        //     },
        //     plugins: [ChartDataLabels],
        //     options: option
        // });

        // new Chart("bar-chart3", {
        //     type: 'bar',
        //     data: {
        //         labels: months,
        //         datasets: [{
        //             label: 'Total ',
        //             data: [65, 19, 43, 29, 44, 22, 99, 64, 34, 41, 56, 15],
        //             backgroundColor: barColors,
        //             borderColor: borderColors,
        //             borderWidth: 1
        //         }]
        //     },
        //     plugins: [ChartDataLabels],
        //     options: option
        // });

        // new Chart("bar-chart4", {
        //     type: 'bar',
        //     data: {
        //         labels: months,
        //         datasets: [{
        //             label: 'Total ',
        //             data: [
        // <?= $docperjan[0]; ?>,
        // <?= $docperfeb[0]; ?>,
        // <?= $docpermar[0]; ?>,
        // <?= $docperapr[0]; ?>,
        // <?= $docpermay[0]; ?>,
        // <?= $docperjun[0]; ?>,
        // <?= $docperjul[0]; ?>,
        // <?= $docperaug[0]; ?>,
        // <?= $docpersep[0]; ?>,
        // <?= $docperoct[0]; ?>,
        // <?= $docpernov[0]; ?>,
        // <?= $docperdes[0]; ?>,
        //             ],
        //             backgroundColor: barColors,
        //             borderColor: borderColors,
        //             borderWidth: 1
        //         }]
        //     },
        //     plugins: [ChartDataLabels],
        //     options: option
        // });

        let status = ["Berlaku ", "Tidak Berlaku ", "Masa Review "];
        let countStatus = [<?= $b[0]; ?>, <?= $tb[0]; ?>, <?= $mr[0]; ?>];
        let dougColors = ["#22ca80", "#ff4f70", "#fdc16a"];

        new Chart("radar-chart", {
            type: 'doughnut',
            data: {
                labels: status,
                datasets: [{
                    backgroundColor: dougColors,
                    data: countStatus
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    tooltip: {
                        // enabled: false
                    },
                    datalabels: {
                        anchor: 'center',
                        display: true,
                        // backgroundColor: '#ccc',
                        borderRadius: 3,
                        font: {
                            weight: 'bold',
                            size: 15
                        },
                        color: 'white',
                        formatter: convertPercentage,
                    },
                    legend: {
                        display: false
                    },
                }
            }
        });

        let type = ["KPD ", "EBA ", "SLA ", "Ops Memo ", "Reksadana ", "Safekeeping ", "Selling Agent "];
        let countType = [<?= $kpd[0]; ?>, <?= $eba[0]; ?>, <?= $sla[0]; ?>, <?= $om[0]; ?>, <?= $rd[0]; ?>, <?= $sk[0]; ?>, <?= $sa[0]; ?>];
        let pieColors = ["#db3e32", "#384d82", "#2497ab", "#ccac78", "#427840", "#d48787", "#999797"];

        new Chart("pie-chart", {
            type: "pie",
            data: {
                labels: type,
                datasets: [{
                    backgroundColor: pieColors,
                    data: countType
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    tooltip: {
                        // enabled: false
                    },
                    datalabels: {
                        formatter: convertPercentage,
                        color: 'white',
                    },
                    legend: {
                        display: false
                        // align: 'start',
                        // position: 'left',
                        // labels: {
                        //     boxWidth: 20,
                        //     boxHeight: 14
                        // }
                    },
                }
            }
        });
    </script>
</body>

</html>