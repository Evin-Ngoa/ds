<?php
// header('Content-type: text/html');
$ini = parse_ini_file('catalogue.ini');
$database = include('config.php');
include('functions.php');

// $county = "Sierra-Leone";
$county = "Mozambique";

// Check if Get Exists
if (isset($_GET['country'])) {
	$county = $_GET['country'];
} else {
	$county = "";
}

$query = "SELECT * FROM covid WHERE country_name = " . $county . "";
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Covid 19 Africa Statistics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark" data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content" style="margin-top: 0px;">
                <div class="container-fluid" style="max-width: 95%;">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Africa CDC Covid 19 Statistics</h4>

                                <div class="page-title-right">
                                Global Query : <h5 class="mb-0 font-size-15"><?=$query;?></h5>
                                    <ol class="breadcrumb m-0" style="display: block;">
                                    <?php
                                        $tokens = Tokenizer($query);
                                        $algebraicquery =  QueryDecomposer($tokens);
                                    ?>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Algebraic Query : <?=$algebraicquery;?></a></li>
                                        <!-- <li class="breadcrumb-item active">Horizontal Layout</li> -->
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <div class="row">
                        <!-- Left Sidebar -->
                        <div class="col-3">
                            <!-- Left sidebar -->
                            <div class="email-leftbar card">
                        
                                <h6 class="mt-4">African Countries</h6>

                                <div class="mt-2">
                                    <a href="./countries.php?country=Kenya" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/kenya.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Kenya</p>
                                            <p class="text-muted">East</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Uganda" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/uganda.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Uganda</p>
                                            <p class="text-muted">East</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Tanzania" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Tanzania.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Tanzania</p>
                                            <p class="text-muted">East</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Rwanda" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Rwanda.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Rwanda</p>
                                            <p class="text-muted">East</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Zimbabwe" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/zimbabwe.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Zimbabwe</p>
                                            <p class="text-muted">South</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=South-Africa" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/south-africa.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">South Africa</p>
                                            <p class="text-muted">South</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Botswana" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Botswana.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Botswana</p>
                                            <p class="text-muted">South</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Mozambique" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Mozambique.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Mozambique</p>
                                            <p class="text-muted">South</p>
                                        </div>
                                    </a>
             
                                </div>
                            </div>
                            <!-- End Left sidebar -->
                        </div>
                        <!-- Left Sidebar -->

                        <!-- Table -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">My Records</h4>

                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Country Code [ID]</th>
                                                    <th scope="col">Region </th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">Covid Cases</th>
                                                    <th scope="col">Male</th>
                                                    <th scope="col">Female</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                dataLocalizer($algebraicquery, $query, $ini, $database);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->

                        <!-- Right Sidebar -->
                        <div class="col-3">
                            <!-- Left sidebar -->
                            <div class="email-leftbar card">
                        
                                <h6 class="mt-4">African Countries</h6>

                                <div class="mt-2">
                                    <a href="./countries.php?country=Niger" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Niger.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Niger</p>
                                            <p class="text-muted">West</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Nigeria" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Nigeria.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Nigeria</p>
                                            <p class="text-muted">West</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Sierra-Leone" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Sierra-Leone.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Sierra Leone</p>
                                            <p class="text-muted">West</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Senegal" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Senegal.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Senegal</p>
                                            <p class="text-muted">West</p>
                                        </div>
                                    </a>
                                    <a href="./countries.php?country=Ghana" class="media">
                                        <img class="d-flex mr-3 rounded-circle" src="assets/flags/Ghana.png"
                                            alt="Generic placeholder image" height="36">
                                        <div class="media-body chat-user-box">
                                            <p class="user-title m-0">Ghana</p>
                                            <p class="text-muted">West</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- End Left sidebar -->
                        </div>
                        <!-- Right Sidebar -->

                    </div>


               
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Evingtone.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Hesbon
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <script src="assets/js/app.js"></script>
</body>


</html>

