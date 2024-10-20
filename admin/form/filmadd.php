<?php  
include "../../connect/db.php";
session_start();

$name = $_POST["name"];
$info = $_POST["info"];
$tür = $_POST["tur"];
$date = $_POST["date"];
$img = null; 


if ($name && $info && $tür && $date && isset($_FILES['img'])) {


    $targetDir = "../resimler/";
    $imgName = basename($_FILES['img']['name']);
    $targetFilePath = $targetDir . $imgName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

   
    $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (in_array($fileType, $allowTypes)) {
        // Dosyayı sunucuya yükle
        if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
            $img = $imgName; 
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Resim yüklenirken bir hata oluştu."
            ];
            header("location:../filmaddform.php");
            exit;
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Sadece JPG, JPEG, PNG ve GIF dosyaları yüklenebilir."
        ];
        header("location:../filmaddform.php");
        exit;
    }

    // Aynı isimde bir film olup olmadığını kontrol et
    $filmKontrol = $conn->prepare("SELECT * FROM film WHERE name = :name");
    $filmKontrol->execute(['name' => $name]);
    $varMi = $filmKontrol->fetch(PDO::FETCH_ASSOC);

    if (!$varMi) {
        // Filmi ekle
        $sorgu = $conn->prepare("INSERT INTO film (name, info, tur, img, date) VALUES (:name, :info, :tur, :img, :date)");
        $sorgu->execute([
            'name' => $name,
            'info' => $info,
            'tur' => $tür,
            'img' => $img, // Resim dosyasının adını kaydet
            'date' => $date
        ]);

        // Başarı mesajını session'da sakla
        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Film başarıyla eklendi."
        ];
        header("location:../filmaddform.php");
    } else {
        // Aynı isimde bir film zaten varsa hata mesajı
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Bu isimde bir film zaten mevcut."
        ];
        header("location:../filmaddform.php");
    }
} else {
    // Alanlar boş bırakıldıysa hata mesajı
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Lütfen tüm alanları doldurun."
    ];
    header("location:../filmaddform.php");
}
?>
