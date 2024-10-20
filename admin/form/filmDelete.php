<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filmID = $_POST['id'];
    
    if (isset($filmID) && !empty($filmID)) {
        $filmID = intval($filmID);

        $silmeSorgusu = $conn->prepare("DELETE FROM film WHERE id = :id");
        $silmeSorgusu->bindParam(':id', $filmID);

        if ($silmeSorgusu->execute()) {
            $_SESSION["message"] = [
                "durum" => "true",
                "text" => "Film Başarıyla silindi."
            ];
            header("Location:../filmDel.php"); 
            exit;
        } else {
            $_SESSION["message"] = [
                "durum" => "false",
                "text" => "Film silinirken bir Hata Oluştu."
            ];
            header("Location:../filmDel.php"); 
            exit;
        }
    } else {
        $_SESSION["message"] = [
            "durum" => "false",
            "text" => "Geçersiz Film"
        ];
        header("Location:../filmDel.php"); 
        exit;
    }
} else {
    $_SESSION["message"] = [
        "durum" => "false",
        "text" => "Film silinirken bir Hata Oluştu."
    ];
    header("Location:../filmDel.php"); 
    exit;
}


