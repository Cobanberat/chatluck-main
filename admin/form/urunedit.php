<?php
session_start();
include "../../connect/db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$info = $_POST['info'];
$parent = $_POST['parent'];
$durum = $_POST['durum'];

$existingImage = "";
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_NO_FILE) {
    $stmt = $conn->prepare("SELECT img FROM urun WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $urun = $stmt->fetch(PDO::FETCH_ASSOC);
    $existingImage = $urun['img'];
}

if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    $targetDir = "../uploads/"; 
    $targetFile = $targetDir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedExtensions)) {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Sadece JPG, JPEG, PNG ve GIF uzantılı dosyalar yükleyebilirsiniz."
        ];
        header("location:../uruneditform.php");
        exit;
    }

    if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
        $existingImage = basename($_FILES["img"]["name"]);
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Resim yüklenirken bir hata oluştu."
        ];
        header("location:../uruneditform.php");
        exit;
    }
}

$sorgu = $conn->prepare("UPDATE urun SET name = :name, info = :info, parent_id = :parent, img = :img, durum = :durum WHERE id = :id");
$sorgu->bindParam(':name', $name);
$sorgu->bindParam(':info', $info);
$sorgu->bindParam(':parent', $parent);
$sorgu->bindParam(':img', $existingImage);
$sorgu->bindParam(':durum', $durum);
$sorgu->bindParam(':id', $id);

if ($sorgu->execute()) {
    $_SESSION["message"] = [
        "durum" => "true",
        "text" => "Ürün başarıyla güncellendi."
    ];
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Güncelleme işlemi sırasında bir hata oluştu."
    ];
}

header("location:../uruneditform.php");
exit;
?>
