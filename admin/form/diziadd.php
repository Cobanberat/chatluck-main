<?php
session_start();
include "../../connect/db.php"; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $info = $_POST['info'];
    $tur = $_POST['tur'];
    $date = $_POST['date'];
    $img = null;

    
    if (!empty($_FILES['img']['name'])) {
        $targetDir = "../resimler/"; 
        $imgName = basename($_FILES['img']['name']);
        $targetFilePath = $targetDir . $imgName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            // Dosyayı yükle
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
                $img = $imgName; 
            } else {
                $_SESSION["message"] = [
                    "durum" => "false",
                    "text" => "Resim yüklenirken bir hata oluştu!"
                ];
                header("Location: ../diziaddform.php");
                exit;
            }
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Sadece JPG, JPEG, PNG ve GIF dosyaları yüklenebilir."
            ];
            header("Location: ../diziaddform.php");
            exit;
        }
    }

    // Tüm alanlar doldurulmuş mu kontrol et
    if ($name && $info && $tur && $date && $img) {
        try {
            // Diziyi veritabanına ekle
            $stmt = $conn->prepare("INSERT INTO dizi (name, info, tur, img, date) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $info, $tur, $img, $date]);

            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "Dizi başarıyla eklendi."
            ];
            header("Location: ../diziaddform.php");
        } catch (PDOException $e) {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Dizi eklenirken bir hata oluştu!"
            ];
            header("Location: ../diziaddform.php");
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Lütfen tüm alanları doldurun!"
        ];
        header("Location: ../diziaddform.php");
    }
} else {
    header("Location: ../diziaddform.php");
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Dizi Eklenirken Bir Hata Oluştu."
    ];
}
