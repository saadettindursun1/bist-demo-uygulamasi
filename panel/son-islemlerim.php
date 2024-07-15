<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        Demobist | Borsa istanbul Simülasyonu
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<?php 
require "connection.php";

?>

<body class="g-sidenav-show  bg-gray-200">

    <?php include("menu.php"); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php 
        include("navbar.php");

        $transactions = $bistSql->user_transactions($user_id,30);
        ?>
        <!-- End Navbar -->


        <div class="col-md-8 m-4">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Son İşlemlerim</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                            <i class="material-icons me-2 text-lg">filter_list</i>
                            <small>Son 30 işlem listeleniyor..</small>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">İşlemler</h6>
                    <ul class="list-group">
                        <?php foreach($transactions as $t): ?>
                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex col-5 align-items-center">
                                <button
                                    class="btn btn-icon-only btn-rounded mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center <?php echo $t["status"]?"btn-outline-success":"btn-outline-danger" ?>">
                                    <i
                                        class="material-icons text-lg"><?php echo $t["status"]?"expand_less":"expand_more" ?></i>
                                </button>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">
                                        <?php echo $t["stock_name"]." / ". $bist_name_values[$t["stock_name"]] ?></h6>
                                    <span class="text-xs"><?php echo $t["created_at"] ?></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <p class="text-sm mt-1">
                                    <?php 

                                    $price = round((floatval($t["total_amount"]) / intval( $t["stock_quantity"])),2);
                                    echo $t["stock_quantity"]." adet / ";
                                     echo $t["status"]?"Alım":"Satım";
                                     echo "<br><strong> İşlem Fiyatı$price ₺</strong>";
                                     ?>
                            
                            </p>
                            </div>
                          
                            <div
                                class="d-flex col-1  align-items-center text-gradient text-sm font-weight-bold <?php echo $t["status"]?"text-success":"text-danger" ?>">
                                <?php echo $t["total_amount"]." ₺" ?>
                            </div>
                        </li>
                        <hr>
                        <?php endforeach; ?>

                    </ul>

                </div>
            </div>
        </div>



    </main>
    <?php 
    include("tasarimci.php");
    ?>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        $("#son-islemlerim").addClass("active bg-gradient-primary");
    });
    </script>
</body>

</html>