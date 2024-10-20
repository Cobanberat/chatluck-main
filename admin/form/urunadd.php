<?php
session_start();
include "../../connect/db.php";


$name = $_POST['name'];
$info = $_POST['info'];
$parent = $_POST['parent'];
$img = $_FILES['img'];


$targetDir = "../resimler/";
$imgName = basename($img["name"]);
$targetFile = $targetDir . $imgName;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

$validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageFileType, $validExtensions)) {
    $_SESSION['message'] = [
        'durum' => 'false',
        'text' => 'Sadece JPG, JPEG, PNG ve GIF dosya formatları kabul edilir.'
    ];
    header("Location: ../urunaddform.php");
    exit();
}

if (move_uploaded_file($img["tmp_name"], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO urun (name, info, parent_id, img, created_at) VALUES (:name, :info, :parent, :img, NOW())");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':info', $info);
    $stmt->bindParam(':parent', $parent);
    $stmt->bindParam(':img', $imgName); 

    if ($stmt->execute()) {
        $_SESSION['message'] = [
            'durum' => 'true',
            'text' => 'Ürün başarıyla eklendi.'
        ];
    } else {
        $_SESSION['message'] = [
            'durum' => 'false',
            'text' => 'Ürün eklenirken bir hata oluştu.'
        ];
    }
} else {
    $_SESSION['message'] = [
        'durum' => 'false',
        'text' => 'Resim yüklenirken bir hata oluştu.'
    ];
}

// Yönlendirme
header("Location: ../urunaddform.php");
exit();
