<?php


class bistSql
{

    public function connectMysql()
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];;
        $password = $_ENV['DB_PASS'];;


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

    function insert($table, $value_name, $data)
    {
        try {
            $conn = $this->connectMysql();

            // Prepared statement kullanımı
            $placeholders = implode(',', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO $table ($value_name) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);
            // Prepared statement parametrelerini bağlama
            $stmt->execute(array_values($data));

            $lastInsertedId = $conn->lastInsertId();

            return $lastInsertedId;
        } catch (PDOException $e) {
            return  $e->getMessage();
        } finally {
            $conn = null;
        }
    }
}
