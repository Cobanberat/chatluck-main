<?php  
include "../../connect/db.php";
session_start();

$name = $_POST["name"];
$info = $_POST["info"];
$tür = $_POST["tür"];
$date = $_POST["date"];
$img = null; // Başlangıçta resim null

// Tüm alanlar doldurulmuş mu kontrol et
if ($name && $info && $tür && $date && isset($_FILES['img'])) {

    // Resim dosyasını kontrol et
    $targetDir = "../resimler/";
    $imgName = basename($_FILES['img']['name']);
    $targetFilePath = $targetDir . $imgName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Yalnızca belirli uzantılara izin ver
    $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (in_array($fileType, $allowTypes)) {
        // Dosyayı sunucuya yükle
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
            $img = $imgName; // Dosya ismini veritabanına kaydetmek için sakla
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Resim yüklenirken bir hata oluştu."
            ];
            header("location:../oyunaddform.php");
            exit;
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Sadece JPG, JPEG, PNG ve GIF dosyaları yüklenebilir."
        ];
        header("location:../oyunaddform.php");
        exit;
    }

    // Aynı isimde bir oyun olup olmadığını kontrol et
    $oyunKontrol = $conn->prepare("SELECT * FROM oyun WHERE name = :name");
    $oyunKontrol->execute(['name' => $name]);
    $varMi = $oyunKontrol->fetch(PDO::FETCH_ASSOC);

    if (!$varMi) {
        // Oyunu ekle
        $sorgu = $conn->prepare("INSERT INTO oyun (name, info, tur, img, date) VALUES (:name, :info, :tur, :img, :date)");
        $sorgu->execute([
            'name' => $name,
            'info' => $info,
            'tur' => $tür,
            'img' => $img, // Resim dosyasının adını kaydet
            'date' => $date
        ]);

        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Oyun başarıyla eklendi."
        ];
        header("location:../oyunaddform.php");
    } else {
        // Aynı isimde bir oyun zaten varsa hata mesajı
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Bu isimde bir oyun zaten mevcut."
        ];
        header("location:../oyunaddform.php");
    }
} else {
    // Alanlar boş bırakıldıysa hata mesajı
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen tüm alanları doldurun."
    ];
    header("location:../oyunaddform.php");
}
?>
