<?php
session_start(); 
include "../connect/db.php";

$tur = $_POST["cihaz_turu"];
$marka = $_POST["marka"];
$model = $_POST["model"];
$ariza = $_POST["ariza"];
$user_id = $_SESSION["user"]["user_id"];

if ($tur && $marka && $model && $ariza && $user_id) {
    try {
        // Veritabanı bağlantısını kontrol et
        if (!$conn) {
            throw new Exception("Veritabanı bağlantısı başarısız");
        }

        // PDO hata ayıklama modunu aç
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // SQL sorgusu
        $sql = "INSERT INTO ariza (user_id, cihaz, marka, model, ariza) 
                VALUES (:user_id, :cihaz_turu, :marka, :model, :ariza)";
        
        // Hazırlanan sorgu
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cihaz_turu', $tur, PDO::PARAM_STR);
        $stmt->bindParam(':marka', $marka, PDO::PARAM_STR);
        $stmt->bindParam(':model', $model, PDO::PARAM_STR);
        $stmt->bindParam(':ariza', $ariza, PDO::PARAM_STR);
        
        // Sorguyu çalıştır
        $stmt->execute();
        
        // Başarı mesajı
        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Arızanız Başarılı Şekilde Kaydedildi Lütfen Cihazı Bize Getirin"
        ];
        header("Location:../index/fault.php");
        exit;
    } catch (PDOException $e) {
        // Hata mesajı
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Arızanız Kaydedilirken Bir Hata Oluştu: " . $e->getMessage()
        ];
        header("Location:../index/fault.php");
        exit;
    }
} else {
    // Eksik alan mesajı
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen Tüm Alanları Doldurun"
    ];
    header("Location:../index/fault.php");
    exit;
}
?>
