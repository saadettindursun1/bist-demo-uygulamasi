<?php
ob_start();

require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demobist - Giriş Yap</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <?php

    if (isset($_POST['login'])) {
        $result = false;
        $message = "Giriş başarısız.";
        // Post verilerini doğrudan kullanmak yerine doğrulama ve temizleme işlemi
        $mail = isset($_POST['mail']) ? htmlspecialchars(stripslashes(trim($_POST['mail']))) : '';
        $pass = isset($_POST['pass']) ? htmlspecialchars(stripslashes(trim($_POST['pass']))) : '';

        require_once "connection.php";

        $email_crypt = $bistCrypt->code_encrypt($mail);
        $pass_crypt = $bistCrypt->code_encrypt($pass);

        if ((isset($mail) && $mail != null) && isset($pass) && $pass != null) {


            $sql_control = "SELECT * FROM demobist_users x JOIN demobist_wallet y ON x.user_id = y.user_id WHERE x.user_mail = :user_mail and x.user_pass = :user_pass and x.user_status=1";
            $stmt_control = $bistSql->connectMysql()->prepare($sql_control);
            $stmt_control->execute([':user_mail' => $email_crypt, ':user_pass' => $pass_crypt]);
            $control_result = $stmt_control->fetch(PDO::FETCH_ASSOC);

            if ($control_result) {
                $result = true;
                $message = "Giriş başarılı. Yönlendiriliyorsunuz....";
            }
        }
    }
    ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form method="post" class="login100-form validate-form">
                    <span class="login100-form-title p-b-49">
                        Giriş Yap
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="E mail">
                        <span class="label-input100">E mail</span>
                        <input class="input100" type="email" name="mail" placeholder="E mail adresiniz.." required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Parola">
                        <span class="label-input100">Parola</span>
                        <input class="input100" type="password" name="pass" placeholder="Parolanız..." required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="text-right p-t-8 p-b-31">
                        <a href="#">
                            Şifremi unuttum ?
                        </a>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button name="login" value="login" class="login100-form-btn">
                                Giriş
                            </button>
                        </div>
                    </div>
                    <div class="flex-col p-t-10">
                        <span style="text-decoration: underline;"> <?php
                                                                    if (isset($result)) {
                                                                        echo $message;
                                                                        if ($result) {

                                                                            session_unset();
                                                                            @session_destroy();
                                                                            // Yeni bir oturum başat ve oturum değişkenlerini ata
                                                                            session_start();
                                                                            $_SESSION["user_control"] = true;
                                                                            $_SESSION["mail"] = $mail;
                                                                            $_SESSION["amount"] = $control_result["total"];
                                                                            $_SESSION["stock_wallet"] = $bistSql->update_stock_wallet($control_result["user_id"]);
                                                                            session_regenerate_id();

                                                                            header("Refresh:0;Url=panel/anasayfa");
                                                                        }
                                                                    }
                                                                    ?></span>
                    </div>

                    <div class="flex-col-c p-t-45">


                        <a href="index"><img src="images/demobist-logo-kare.webp" width="100" alt="Demobist logosu"></a>
                    </div>

                    <div class="flex-col-c p-t-15">
                        <span class="txt1 p-b-17">
                            Demobist hesabın yok mu ?
                        </span>

                        <a href="kayit" class="txt2">
                            Hemen kayıt ol
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->

</body>

</html>