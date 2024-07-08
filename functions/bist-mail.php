<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/Exception.php';
require dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require dirname(__DIR__).'/vendor/phpmailer/phpmailer/src/SMTP.php';


class bistMailer
{

    function sendMail($recipients, $content, $content_subject)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings

        $mail->CharSet = 'UTF-8';
        $mail->SMTPKeepAlive = true;
        $mail->SMTPDebug = 0; // Debug mode (SMTP::DEBUG_OFF for no output)
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST']; // SMTP server from .env file
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $_ENV['SMTP_MAIL']; // SMTP username from .env file
        $mail->Password = $_ENV['SMTP_PASSWORD']; // SMTP password from .env file

        // SMTP security
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use PHPMailer::ENCRYPTION_SMTPS for SSL
        $mail->Port = $_ENV['SMTP_PORT']; // Port from .env file

        // From address
        $mail->setFrom($_ENV['SMTP_MAIL'], 'Demobist - Yatırım Simülasyonu');

        // Add recipients
        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $content_subject;
        $mail->Body = $content;


        $mail->send();
        // echo 'Mesajınız Gönderildi.';
    } catch (Exception $e) {
        echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
    }
}

}
