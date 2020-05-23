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
    $county = "Kenya";
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

                                <div class="page-title-right" style="display: none;">
                                    Global Query : <h5 class="mb-0 font-size-15"><?= $query; ?></h5>
                                    <ol class="breadcrumb m-0" style="display: block;">
                                        <?php
                                        $tokens = Tokenizer($query);
                                        $algebraicquery =  QueryDecomposer($tokens);
                                        ?>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Algebraic Query : <?= $algebraicquery; ?></a></li>
                                        <!-- <li class="breadcrumb-item active">Horizontal Layout</li> -->
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <div class="row">
                        <!-- Table -->
                        <div class="col-9">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="media">
                                                        <div class="mr-3">
                                                            <img src="./assets/flags/acdc.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <div class="text-muted">
                                                                <p class="mb-2">Welcome to Africa CDC dashboard</p>
                                                                <h5 class="mb-1">African CDC</h5>
                                                                <p class="mb-0">African Union</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 align-self-center">
                                                    <div class="text-lg-center mt-4 mt-lg-0">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div>
                                                                    <p class="text-muted text-truncate mb-2">Regions</p>
                                                                    <h5 class="mb-0">3</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div>
                                                                    <p class="text-muted text-truncate mb-2">Countries</p>
                                                                    <h5 class="mb-0">13</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div>
                                                                    <p class="text-muted text-truncate mb-2">Clients</p>
                                                                    <h5 class="mb-0">18</h5>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                        <!-- Table -->

                        <!-- Right Sidebar -->
                        <div class="col-3">
                            <!-- Left sidebar -->
                            <div class="email-leftbar card">

                                <h6 class="mt-4">Menu</h6>

                                <div class="mt-2">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        <a href="./index.php" class="btn btn-secondary"> Dashboard </a>
                                        <a href="./countries.php?country=Kenya" class="btn btn-secondary"> Countries Statistics </a>
                                        <a href="./regions.php?region=East" class="btn btn-secondary"> Regional Statistics </a>
                                    </div>
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
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Evingtone.
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

</body>


</html>