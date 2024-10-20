<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oyunID = $_POST['id'];

    if (isset($oyunID) && !empty($oyunID)) {
        $oyunID = intval($oyunID);

        $silmeSorgusu = $conn->prepare("DELETE FROM oyun WHERE id = :id");
        $silmeSorgusu->bindParam(':id', $oyunID);

        if ($silmeSorgusu->execute()) {
            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "oyun Başarıyla silindi."
            ];
            header("Location:../oyundel.php"); 
            exit;
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "oyun silinirken bir Hata Oluştu."
            ];
            header("Location:../oyundel.php"); 
            exit;
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Geçersiz Oyun"
        ];
        header("Location:../oyundel.php"); 
        exit;
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "oyun silinirken bir Hata Oluştu."
    ];
    header("Location:../oyundel.php"); 
    exit;
}


