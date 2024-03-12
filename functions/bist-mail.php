<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


class bistMailer
{

    function sendMail($recipients, $content, $content_subject)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPKeepAlive = true;

            $mail->SMTPDebug = 0; // debug on - off
            $mail->isSMTP();
            $mail->Host = "mail.saadettindursun.com.tr"; // SMTP sunucusu örnek : mail.alanadi.com
            $mail->SMTPAuth = true; // SMTP Doğrulama
            $mail->Username = "saadettin@saadettindursun.com.tr"; // Mail kullanıcı adı
            $mail->Password = "25912414660Sd."; // Mail şifresi
            $mail->SMTPSecure = "ssl"; // Şifreleme
            $mail->Port = "465"; // SMTP Port
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => true,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
                )
            );

            // Gönderen
            $mail->setfrom("saadettin@saadettindursun.com.tr", 'Demobist - Yatırım Simülasyonu');

            // Alıcıları ekle
            foreach ($recipients as $recipient) {
                $mail->addAddress($recipient);
            }

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = $content_subject;
            $mail->Body = $content;
            $mail->send();
            // Başarı mesajı
            // echo 'Mesajınız Gönderildi.';
        } catch (Exception $e) {
            echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
        }
    }
}
