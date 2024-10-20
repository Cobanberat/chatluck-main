<?php 
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $info = $_POST['info'];
    $date = $_POST['date'];
    $durum = isset($_POST['durum']) ? 1 : 0;

    $img = null;
    if (!empty($_FILES['img']['name'])) {
        $targetDir = "../resimler/";
        $imgName = basename($_FILES['img']['name']);
        $targetFilePath = $targetDir . $imgName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            // Dosya yükle
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
                $img = $imgName; 
            } else {
                $_SESSION["message"] = [
                    "durum" => "false",
                    "text" => "Resim Yüklenirken Bir Hata Oluştu!"
                ];
                header("Location:../filmeditform.php");
                exit;
            }
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Sadece JPG, JPEG, PNG ve GIF dosyaları yüklenebilir."
            ];
            header("Location:../filmeditform.php");
            exit;
        }
    }

    try {
        if ($img) {
            $stmt = $conn->prepare("UPDATE film SET name = ?, info = ?, date = ?, img = ?, durum = ? WHERE id = ?");
            $stmt->execute([$name, $info, $date, $img, $durum, $id]);
        } else {
            $stmt = $conn->prepare("UPDATE film SET name = ?, info = ?, date = ?, durum = ? WHERE id = ?");
            $stmt->execute([$name, $info, $date, $durum, $id]);
        }

        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Film Başarıyla Güncellendi"
        ];
        header("Location:../filmeditform.php");
    } catch (PDOException $e) {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Film Güncellenirken Bir Hata Oluştu!"
        ];
        header("Location:../filmeditform.php");
    }
} else {
    header("Location:../filmeditform.php");
}
