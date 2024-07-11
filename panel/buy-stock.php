<?php
// session_start() çağrısını sayfanızın başına ekleyin
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buy_csrf_token']) && $_POST['buy_csrf_token'] === $_SESSION['buy_csrf_token']) {
        // POST verisi ve CSRF token doğrulandı

        $errors = [];

        if (isset($_POST['qty']) && filter_var($_POST['qty'], FILTER_VALIDATE_INT)) {
            $qty = (int)$_POST['qty'];
        } else {
            $errors[] = 'Invalid quantity';
        }
        if (isset($_POST['stock_id']) && filter_var($_POST['stock_id'], FILTER_VALIDATE_INT)) {
            $stock_id = (int)$_POST['stock_id'];
        } else {
            $errors[] = 'Invalid stock id';
        }

        if (isset($_POST['total']) && filter_var($_POST['total'], FILTER_VALIDATE_INT)) {
            $total = (int)$_POST['total'];
        } else {
            $errors[] = 'Invalid total';
        }
        if (isset($_POST['process'])) {
            $process = $_POST['process'];
        } else {
            $errors[] = 'Invalid process';
        }



        // Hataları işle
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        } else {
            // Hatalar yoksa işlem yapabilirsiniz


            require "connection.php";

            if ($process == "buy") {
                $user_amount = $_SESSION["amount"];


                //eğer kullanıcının bakiyesi yeterli ise
                if ($user_amount >= $total) {

                    //bakiyeden düşme
                    $responseDecrease = $bistSql->decreaseAmount($user_id, $total);

                    if ($responseDecrease == true) {
                        //eğer bu hisse cüzdanda mevcut ise güncelleme yapılacak
                        if ($bistSql->haveStock($user_id, $stock_id)) {
                            $bistSql->update_stock($user_id, $stock_id, $qty, $total);
                        }


                        //hisse cüzdanda yoksa ekleme yapılacak
                        else {

                            $table = "demobist_stock_wallet";
                            $values = "user_id,stock_id,stock_quantity,total_amount";
                            $data = [
                                "user_id" => $user_id,
                                "stock_id" => $stock_id,
                                "stock_quantity" => $qty,
                                "total_amount" => $total,
                            ];
                            $bistSql->insert($table, $values, $data);
                        }
                        $_SESSION["stock_wallet"] = $bistSql->update_stock_wallet($user_id);
                        $_SESSION["amount"] = $user_amount - $total;
                        echo "Hisse Alımı Başarılı";
                    } else {
                        echo $responseDecrease;
                    }
                } else {
                    echo 'Yetersiz bakiye..';
                }
            }
            if($process=="sell"){
                $stock_count = $bistSql->countStock($user_id, $stock_id);


                //eğer kullanıcının satmak istediği adet miktarı  elinde mecvut ise 
                if ($stock_count >= $qty) {

                    //bakiye ekleme
                    $responseDecrease = $bistSql->decreaseAmount($user_id, -$total);

                    if ($responseDecrease == true) {

                            //stok düşülüyor..
                            $bistSql->update_stock($user_id, $stock_id, -$qty, -$total);

                       
                        $_SESSION["stock_wallet"] = $bistSql->update_stock_wallet($user_id);
                        $_SESSION["amount"]  += $total;
                        echo "Hisse Satımı Başarılı";
                    } else {
                        echo $responseDecrease;
                    }
                } else {
                    echo 'Satmak istediğiniz miktar mevcut miktardan fazla olamaz!..';
                }
            }

        }
    } else {
        echo 'Error: Invalid CSRF token.';
    }
} else {
    echo 'Error: Invalid request method.';
}
