<!DOCTYPE html>
<html lang="en">

<head>
    <title>Demobist - Kayıt Ol</title>
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
    if (isset($_POST['register'])) {

        @$mail = $_POST['mail'];
        @$pass = $_POST['pass'];

        if ((isset($mail) && $mail != null) && isset($pass) && $pass != null) {

            require_once "connection.php";

            $table = "demobist_users";
            $values = "user_mail,user_pass,user_register_date,user_status";
            $data = [
                "user_mail" =>  $bistCrypt->code_encrypt($mail),
                "user_pass" => $bistCrypt->code_encrypt($pass),
                "user_register_date" => date("Y-m-d"),
                "user_status" => 0,
            ];


            $insert =  $bistSql->insert($table, $values, $data);
            if ($insert && is_numeric($insert)) {

                $token =  bin2hex(random_bytes(32));

                $activationLink = "localhost/bist/activate?email=" . urlencode($mail) . "&token=" . urlencode($token);


                $table_token = "demobist_tokens";
                $values_token = "user_mail,token,token_status";
                $data_token = [
                    "user_mail" =>  $bistCrypt->code_encrypt($mail),
                    "token" => $token,
                    "token_status" => 0,
                ];

                $table_wallet = "demobist_wallet";
                $values_wallet = "user_id,total";
                $data_wallet = [
                    "user_id" => $insert,
                    "total" => 500000
                ];


                $bistSql->insert($table_token, $values_token, $data_token);
                $bistSql->insert($table_wallet, $values_wallet, $data_wallet);



                $recipients = [$mail];
                $link = "<a href='$activationLink'>linke Tıklayınız..</a>";
                $content = "Merhaba,\n\nHesabınızı aktive etmek için  $link <br> Teşekkürler.";
                $bistMailer->sendMail($recipients, $content, "Aktivitasyon Mesajı");
                $mesaj = "Hesabınız başarıyla oluşturuldu. <br/> Hesabınızı aktifleştirmek için mailinize gelen linke tıklayınız...";
            } else {
                $mesaj = "Girdiğiniz mail adresi zaten mevcut.";
            }
        }
    }

    ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form method="POST" class="login100-form validate-form">
                    <span class="login100-form-title p-b-49">
                        Kayıt Ol
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                        <span class="label-input100">E mail</span>
                        <input class="input100" type="email" name="mail" placeholder="E mail adresiniz.." required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Parola</span>
                        <input class="input100" type="password" name="pass" placeholder="Parolanız..." required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>


                    <br>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button name="register" value="register" class="login100-form-btn">
                                Kayıt Ol
                            </button>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['register'])) {
                        echo '<div class="flex-col-c p-t-45">' . $mesaj . '</div>';
                    } ?>


                    <div class="flex-col-c p-t-45">

                        <a href="index"><img src="images/demobist-logo-kare.webp" width="100" alt="Demobist logosu"></a>
                    </div>

                    <div class="flex-col-c p-t-45">
                        <span class="txt1 p-b-17">
                            Zaten bir hesabın var mı ?
                        </span>
                        <a href="giris" class="txt2">
                            Hemen Giriş Yap
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>