<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demobist - Aktivitasyon</title>
    <link href="tailwind.css" rel="stylesheet" />

</head>

<body>
    <?php
    $status = false;
    if (isset($_GET["email"]) && isset($_GET["token"])) {
        $email = $_GET["email"];
        $token = $_GET["token"];

        require_once "connection.php";

        $email_crypt = $bistCrypt->code_encrypt($email);

        $sql_control = "SELECT user_status FROM demobist_users WHERE user_mail = :user_mail";
        $stmt_control = $bistSql->connectMysql()->prepare($sql_control);
        $stmt_control->execute([':user_mail' => $email_crypt]);
        $control_result = $stmt_control->fetch(PDO::FETCH_ASSOC);
        @$control_result = $control_result["user_status"];

        if ($control_result &&  $control_result == 1) {
            $status = true;
            $message = "Bu hesap zaten aktifleştirilmiş... <a href='giris' class='text-blue-600'>Giriş</a> ekranından devam edebilirsiniz..";
        } else {
            $sql = "UPDATE demobist_tokens SET token_status= :token_status WHERE user_mail= :user_mail and token=:token";
            $sql_users = "UPDATE demobist_users SET user_status= :user_status WHERE user_mail= :user_mail";
            $stmt = $bistSql->connectMysql()->prepare($sql);
            $stmt_users = $bistSql->connectMysql()->prepare($sql_users);

            try {
                // Sorguyu çalıştır
                $result = $stmt->execute(['token_status' => 1, ':user_mail' => $email_crypt, ':token' => $token]);
                $result_users = $stmt_users->execute(['user_status' => 1, ':user_mail' => $email_crypt]);
                $rowCount = $stmt->rowCount();
                if ($rowCount > 0) {
                    $status = true;
                    $message = 'Aktivitasyon Başarılı <a href="giris" class="text-blue-600">giriş</a> ekranından hesabınıza
                    girebilirsiniz.';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                // Diğer PDOException hataları
            }
        }
    }


    if ($status) {
    ?>


        <div class="flex justify-center items-center mt-40">
            <div class="text-center">
                <img class="mx-auto" src="images/icons/demobist-borsa-istanbul-olumlu.svg" alt="Başarılı">
                <h4 class="text-xl mt-10">
                    <?php echo $message; ?>
                </h4>
            </div>
        </div>

    <?php } else { ?>
        <div class="flex justify-center items-center mt-40">
            <div class="text-center">
                <img class="mx-auto" src="images/icons/demobist-borsa-istanbul-olumsuz.svg" alt="Başarılı">
                <h4 class="text-xl mt-10">
                    Aktivitasyon başarısız. Hesabınız yoksa <a href="kayit" class="text-blue-600">kayıt</a> ekranından devam
                    edebilirsiniz..
                </h4>
            </div>
        </div>
    <?php } ?>




</body>

</html>