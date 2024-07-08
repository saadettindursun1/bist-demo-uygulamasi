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

    function update_stock_wallet($user_id){
            $sql_control = "SELECT * FROM demobist_users x JOIN demobist_wallet y ON x.user_id = y.user_id WHERE x.user_mail = :user_mail and x.user_pass = :user_pass and x.user_status=1";

        $sql = "select * from demobist_stock_wallet X JOIN demobist_bist_data y ON x.stock_id=y.stock_id where x.user_id=:user_id";
        $stmt = $this->connectMysql()->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    function listAll($query)
    {
        $conn = $this->connectMysql();
        $sql = $query;

        $data = $conn->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}
