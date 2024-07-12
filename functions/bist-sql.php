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
        $sql = "select * from demobist_stock_wallet X JOIN demobist_bist_data y ON x.stock_id=y.stock_id where x.user_id=:user_id";
        $stmt = $this->connectMysql()->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    function update_stock($user_id,$stock_id,$qty,$amount){
        try {
            $conn = $this->connectMysql();
            $sql_update = "UPDATE demobist_stock_wallet SET stock_quantity = stock_quantity + :qty, total_amount = total_amount + :amount WHERE user_id = :user_id AND stock_id = :stock_id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->execute([':qty'=>$qty, ':amount' => $amount, ':user_id' => $user_id , ':stock_id' => $stock_id]);
            return true;
    
        } catch (PDOException $e) {
            // Hata durumunda hata mesajını logla veya işle
            error_log('update error: ' . $e->getMessage());
            return false;
        }
    }

    function listAll($query)
    {
        $conn = $this->connectMysql();
        $sql = $query;

        $data = $conn->query($sql);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    function decreaseAmount($id,$amount){
        try {
        $conn = $this->connectMysql();
        $sql_update = "UPDATE demobist_wallet SET total = total - :amount WHERE user_id = :user_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([':amount' => $amount, ':user_id' => $id]);
        return true;

    } catch (PDOException $e) {
        // Hata durumunda hata mesajını logla veya işle
        error_log('decreaseAmount error: ' . $e->getMessage());
        return false;
    }

    }

    function haveStock($user_id,$stock_id){
        try {
            // PDO bağlantısını al
            $conn = $this->connectMysql();
    
            // SQL sorgusu
            $sql = "SELECT COUNT(*) as count FROM demobist_stock_wallet WHERE user_id = :user_id AND stock_id = :stock_id";
    
            // SQL sorgusunu hazırla ve çalıştır
            $stmt = $conn->prepare($sql);
            $stmt->execute([':user_id' => $user_id, ':stock_id' => $stock_id]);
    
            // Sonucu al
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // COUNT(*) sonucunu al
            $count = (int) $result['count'];
    
            // Sonucu değerlendir ve true veya false döndür
            return $count > 0 ? true : false;
        } catch (PDOException $e) {
            // Hata durumunda hata mesajını logla veya işle
            error_log('checkUserStock error: ' . $e->getMessage());
            return false;
        }
    }

    function countStock($user_id,$stock_id){
        $sql = "SELECT stock_quantity FROM demobist_stock_wallet WHERE user_id = :user_id AND stock_id = :stock_id";
        $stmt = $this->connectMysql()->prepare($sql);
        
        try {
            $stmt->execute([':user_id' => $user_id, ':stock_id' => $stock_id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($data === false) {
                // Kayıt bulunamadıysa
                return 0;  // Veya uygun bir varsayılan değer
            }
        
            return $data["stock_quantity"];
        } catch (PDOException $e) {
            // Hata meydana geldiğinde
            error_log("Database error: " . $e->getMessage());
            return null;  // Veya uygun bir hata değeri
        }
    }
    function deleteStock($user_id,$stock_id){
        $conn = $this->connectMysql();

        try {
            // Silme sorgusu
            $sql = "DELETE FROM demobist_stock_wallet WHERE user_id = :user_id AND stock_id = :stock_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                echo "Kayıt silindi.";
            } else {
                echo "Silinecek kayıt bulunamadı.";
            }
        } catch (PDOException $e) {
            echo "Silme hatası: " . $e->getMessage();
        }

    }
}
