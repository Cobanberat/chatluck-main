<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
            
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
                $img = $imgName;
            } else {
                $_SESSION["message"] = [
                    "durum" => "false",
                    "text" => "Resim yüklenirken bir hata oluştu!"
                ];
                header("Location: ../dizieditform.php");
                exit;
            }
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Sadece JPG, JPEG, PNG ve GIF dosyaları yüklenebilir."
            ];
            header("Location: ../dizieditform.php");
            exit;
        }
    }

    try {
        if ($img) {
            $stmt = $conn->prepare("UPDATE dizi SET name = ?, info = ?, tur = ?, date = ?, img = ? WHERE id = ?");
            $stmt->execute([$name, $info, $tur, $date, $img, $id]);
        } else {
            $stmt = $conn->prepare("UPDATE dizi SET name = ?, info = ?, tur = ?, date = ? WHERE id = ?");
            $stmt->execute([$name, $info, $tur, $date, $id]);
        }

        $_SESSION["message"] = [
            "durum" => "true",
            "text" => "Dizi başarıyla güncellendi."
        ];
        header("Location: ../dizieditform.php");
    } catch (PDOException $e) {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Dizi güncellenirken bir hata oluştu!"
        ];
        header("Location: ../dizieditform.php");
    }
} else {
    header("Location: ../dizieditform.php");
}
