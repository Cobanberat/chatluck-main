<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $diziID = $_POST['id'];
    
    if (isset($diziID) && !empty($diziID)) {
        $diziID = intval($diziID);

        $silmeSorgusu = $conn->prepare("DELETE FROM dizi WHERE id = :id");
        $silmeSorgusu->bindParam(':id', $diziID);

        if ($silmeSorgusu->execute()) {
            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "dizi Başarıyla silindi."
            ];
            header("Location:../diziDel.php"); 
            exit;
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Dizi silinirken bir Hata Oluştu."
            ];
            header("Location:../diziDel.php"); 
            exit;
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Geçersiz Dizi"
        ];
        header("Location:../diziDel.php"); 
        exit;
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Dizi silinirken bir Hata Oluştu."
    ];
    header("Location:../diziDel.php"); 
    exit;
}


