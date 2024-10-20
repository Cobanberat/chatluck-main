<?php
session_start();
include "../../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $urunID = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM urun WHERE id = :id");
    $stmt->bindParam(':id', $urunID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = [
            "durum" => "true",
            "text" => "Ürün Başarıyla Silindi"
        ];
    } else {
        $_SESSION['message'] = [
            "durum" => "false",
            "text" => "Ürün Silinirken Bir hata Oluştu"
        ];
    }
} else {
    $_SESSION['message'] = [
        "durum" => "false",
        "text" => "Geçersiz Ürün"
    ];
}

header("Location: ../urundel.php");
exit();

