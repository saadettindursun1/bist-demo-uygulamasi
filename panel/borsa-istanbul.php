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
<style>
.hidden {
    display: none;
}

.stock-input {
    border: 1px solid #d2d6da;
    border-radius: 0.375rem;
    padding-left: 10px;
}
</style>
<?php
require "connection.php";

$bist_data = $bistSql->listAll("select * from demobist_bist_data");

$bist_stocks = $_SESSION["stock_wallet"];

$buy_csrf_token = bin2hex(random_bytes(32));
$_SESSION["buy_csrf_token"] = $buy_csrf_token;

?>

<body class="g-sidenav-show  bg-gray-200">

    <?php include "menu.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php
        include "navbar.php";
        ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Borsa İstanbul Hisseleri</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Hisse Adı</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Hisse Fiyatı</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Değişim</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Al/Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bist_data as $b) : ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?php echo $b["stock_name"] ?></h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <?php echo $bist_name_values[$b["stock_name"]]; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?php echo $b["stock_value"] ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-success <?php
                                                                                                    $bg_color = $b["stock_percentage"] > 0 ? "bg-gradient-success" : "bg-gradient-danger";
                                                                                                    echo $bg_color;
                                                                                                    ?>"><?php echo $b["stock_percentage"] ?>%
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn bg-gradient-info w-60 mb-0 toast-btn" type="button"
                                                    data-toggle="modal" data-target="#myModal"
                                                    onclick='buyOrsellFunc(<?php echo htmlspecialchars(json_encode($b), ENT_QUOTES, "UTF-8"); ?>)'>
                                                    Al / Sat
                                                </button>
                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Hisse Alım / Satım</h4>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Buy/Sell Buttons -->
                            <div class="d-flex justify-content-center mb-3">
                                <button type="button" class="btn btn-success mr-2 w-50" id="buyBtn">Alım</button>
                                <button type="button" class="btn btn-danger w-50" id="sellBtn">Satım</button>
                            </div>

                            <!-- Buy Form -->
                            <div id="buyForm">
                                <input type="hidden" id="buy_stock_id">
                                <div class=" mb-3">
                                    <label class="form-label">Hisse Adı</label>
                                    <input type="text" class="form-control stock-input" id="buy_stock_name" readonly>
                                </div>
                                <div class=" mb-3">
                                    <label class="form-label">Fiyat</label>
                                    <input type="text" class="form-control stock-input" id="buy_stock_value" readonly>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Adet</label>
                                    <input type="number" id="stock_qty" class="form-control stock-input">
                                </div>
                                <div class=" mb-3">
                                    <label class="form-label">Toplam Tutar</label>
                                    <label id="stock_total_amount"></label> <label> ₺</label>
                                    <br>
                                    Kullanılabilir Bakiye : <label id="user_amount"><?php echo $_SESSION["amount"]; ?></label>
                                </div>
                                <button type="button" id="buy_stock_btn" class="btn btn-primary btn-block w-100" onclick="buy_stock_func()" disabled>Satın Al</button>
                            </div>

                            <!-- Sell Form -->
                            <div id="sellForm" class="hidden">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Hisse Adı</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Fiyat</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Adet</label>
                                    <input type="text" class="form-control">
                                </div>
                                <button type="button" class="btn btn-warning btn-block w-100">Satış
                                    Gerçekleştir</button>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Hisse Portfoyüm</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Hisse Senedi</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Satılabilir Adet</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Son Fiyat</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Maliyet</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Getiri</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tutar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($bist_stocks as $bist_stock) :
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <!-- <div>
                                                        <img src="./assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                                    </div> -->
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?php echo $bist_stock["stock_name"] ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-xs font-weight-bold"><?php echo $bist_stock["stock_quantity"] ?>
                                                </span>

                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    <?php echo $bist_stock["stock_value"] ?> </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    <?php echo ($bist_stock["total_amount"] / $bist_stock["stock_quantity"]) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                    <div class="progress-info">
                                                        <div class="progress-percentage">
                                                            <span class="text-xs text-success font-weight-bold">%
                                                                <?php
                                                                    $total_amount = floatval($bist_stock["total_amount"]);
                                                                    $stock_quantity = intval($bist_stock["stock_quantity"]);
                                                                    $old_amount = ($total_amount / $stock_quantity);

                                                                    $stock_value = floatval($bist_stock["stock_value"]);
                                                                    $per_win = (($stock_value - $old_amount) / $old_amount) * 100;
                                                                    echo $per_win;
                                                                    ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-success w-60"
                                                            role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    <?php echo $stock_quantity * floatval($bist_stock["stock_value"]); ?>
                                                    ₺ </span>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php
    include "tasarimci.php";
    ?>
    <!--   Core JS Files   -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
    <script>

     function buy_stock_func(){

       var price =   $("#buy_stock_value").val();
       var qty =   $("#stock_qty").val();
       var total = $('#stock_total_amount').text();
       var stock_id = $('#buy_stock_id').val();


        $.ajax({
                    url: 'buy-stock.php', // Verileri alacak PHP sayfasının adı
                    type: 'POST',
                    data: {
                        buy_csrf_token: '<?php echo $buy_csrf_token; ?>',
                        price :price,
                        qty :qty,
                        stock_id :stock_id,
                        total : total

                    },
                    success: function(response) {
                        alert(response);
                       // location.reload();
                    },
                    error: function(error) {
                        console.error('Hata oluştu: ' + error);
                    }
                });
     }

    function buyOrsellFunc(bist_data) {
        var $input = $("#buy_stock_name");
        $("#buy_stock_name").val(bist_data.stock_name);
        $("#buy_stock_id").val(bist_data.stock_id);
        $("#buy_stock_value").val(bist_data.stock_value);
        $("#stock_qty").val(null);
        $('#stock_total_amount').text(null);
        $('#buy_stock_btn').prop("disabled",true );


    }
    $(document).ready(function() {


        $("#borsa-istanbul").addClass("active bg-gradient-primary");


        $("#buyBtn").click(function() {
            $("#buyForm").removeClass("hidden");
            $("#sellForm").addClass("hidden");
        });

        $("#sellBtn").click(function() {
            $("#sellForm").removeClass("hidden");
            $("#buyForm").addClass("hidden");
        });


        function calculateTotalAmount() {
            var stockValue = parseFloat($('#buy_stock_value').val());
            var stockQty = parseInt($('#stock_qty').val());
            var userAmountText = $('#user_amount').text().trim();
            var userAmount = parseFloat(userAmountText.replace(/[^0-9.-]+/g, ''));


            // Eğer her iki değer de geçerliyse toplamı hesapla ve göster
            if (!isNaN(stockValue) && !isNaN(stockQty)) {
                var totalAmount = stockValue * stockQty;

                $('#stock_total_amount').text(totalAmount);

                if (userAmount > totalAmount) {
                    $('#stock_total_amount').css("color","green" );
                    $('#buy_stock_btn').prop("disabled",false );

                }
                else {
                    $('#stock_total_amount').css("color","red" );
                    $('#buy_stock_btn').prop("disabled",true );
                }


            } else {
                $('#stock_total_amount').text('');
                $('#buy_stock_btn').prop("disabled",true );
            }
        }

        $('#stock_qty').on('input', calculateTotalAmount);
        // Stock value input alanında her değişiklik olduğunda hesaplama yap
        $('#buy_stock_value').on('input', calculateTotalAmount);
    });
    </script>
</body>

</html>