<?php


class borsaSql
{

    public function connectMysql()
    {
        $host = "localhost";
        $dbname = "borsa";
        $username = "root";
        $password = "";


        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET NAMES 'utf8mb4'");
            $conn->exec("SET CHARACTER SET utf8mb4");

            return $conn;
        } catch (PDOException $e) {
            // Hata detaylarını günlüğe kaydetme
            error_log('PDO Exception: ' . $e->getMessage(), 0);

            // Genel hata mesajını kullanıcıya gösterme
            die("Bağlantı hatası oluştu. Lütfen daha sonra tekrar deneyiniz.");
        }
    }
}