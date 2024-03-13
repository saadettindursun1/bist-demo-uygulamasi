<?php

// PDO bağlantısı oluşturulması
// Sabah.com.tr'den BIST verilerini çekmek için kullanılacak URL
$url = 'https://www.sabah.com.tr/json/canli-borsa-verileri';

// cURL ile veri çekme işlemi
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// cURL hatası kontrolü
if (curl_errno($ch)) {
    die('cURL Hatası: ' . curl_error($ch));
}
curl_close($ch);

// JSON verisini işleme
$json_data = preg_replace('/^callbackRT\(|\)$/', '', $response);
$data = explode('~', $json_data);

// BIST verilerini saklayacak dizi
$bistData = [];

foreach (array_slice($data, 1, -1) as $veri) {
    list($hisse_adi, $deger, $yuzde) = explode('|', $veri);
    $bistData[$hisse_adi] = compact('deger', 'yuzde');
}


$bist100_hisseleri = ["ASTOR", "BIMAS", "ENJSA", "KCHOL", "KOZAL", "MAVI", "SAHOL", "SISE", "SOKM", "THYAO", "TOASO", "TUPRS", "YKBNK"];




// Tüm verileri veritabanına ekleme
function insertAll($table, $value_names, $data)
{
    require 'functions/bist-sql.php';
    $borsa_sql  = new bistSql();
    try {
        $conn = $borsa_sql->connectMysql();
        $placeholders = implode(',', array_fill(0, count($data[0]), '?'));
        $value_placeholders = implode(',', array_fill(0, count($data), "($placeholders)"));
        $sql = "INSERT INTO $table ($value_names) VALUES $value_placeholders";
        $stmt = $conn->prepare($sql);
        $flat_data = array_merge(...$data);
        $stmt->execute($flat_data);
        return "Kayıt Eklendi";
    } catch (PDOException $e) {
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

// Verileri düzenleme ve güncelleme
function updateData($table, $data)
{
    require 'functions/bist-sql.php';
    $borsa_sql  = new bistSql();
    try {
        $conn = $borsa_sql->connectMysql();
        foreach ($data as $hisse_adi => $veri) {
            $stmt = $conn->prepare("UPDATE $table SET hisse_deger = :deger, hisse_yuzde = :yuzde WHERE hisse_adi = :hisse_adi");
            $stmt->execute([':deger' => $veri['deger'], ':yuzde' => $veri['yuzde'], ':hisse_adi' => $hisse_adi]);
        }
        return "Veriler başarıyla güncellendi";
    } catch (PDOException $e) {
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

// BIST verilerini MySQL'e ekleme
$table = "bist";
$value = "hisse_adi,hisse_deger,hisse_yuzde";
$veriler = array_intersect_key($bistData, array_flip($bist100_hisseleri));
insertAll($table, $value, array_map(function ($hisse_adi, $veri) {
    return [$hisse_adi, $veri['deger'], $veri['yuzde']];
}, array_keys($veriler), $veriler));


echo "Veriler eklendi";

// Güncelleme işlemi
//$update_result = updateData('bist', $bistData);
//echo $update_result;