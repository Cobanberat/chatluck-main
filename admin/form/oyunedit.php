<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oyunID = $_POST['id'];
    $oyunName = $_POST['name'];
    $oyunInfo = $_POST['info'];
    $oyunDate = $_POST['date'];

    if (isset($_FILES['img']['name']) && $_FILES['img']['name'] != '') {
        $targetDir = "../resimler/";
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
        $oyunImg = $_FILES['img']['name'];

        $stmt = $conn->prepare("UPDATE oyun SET name = :name, info = :info, date = :date, img = :img WHERE id = :id");
        $stmt->execute([
            'id' => $oyunID,
            'name' => $oyunName,
            'info' => $oyunInfo,
            'date' => $oyunDate,
            'img' => $oyunImg
        ]);
    } else {
        $stmt = $conn->prepare("UPDATE oyun SET name = :name, info = :info, date = :date WHERE id = :id");
        $stmt->execute([
            'id' => $oyunID,
            'name' => $oyunName,
            'info' => $oyunInfo,
            'date' => $oyunDate
        ]);
    }

    $_SESSION["message"] = [
        "durum" => "true",
        "text" => "Güncelleme Başarıyla Gerçekleştirildi."
    ];
    header('Location:../oyuneditform.php');
    exit();
}
