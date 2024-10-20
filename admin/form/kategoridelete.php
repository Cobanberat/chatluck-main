<?php
session_start();
include "../../connect/db.php";

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $kategoriID = $_POST['id'];

    // Kategori silme sorgusu
    $sorgu = $conn->prepare("DELETE FROM parent WHERE id = :id");
    $sorgu->bindParam(':id', $kategoriID, PDO::PARAM_INT);

    if ($sorgu->execute()) {

        $_SESSION['message'] = [
            'durum' => 'true',
            'text' => 'Kategori başarıyla silindi.'
        ];
    } else {
        $_SESSION['message'] = [
            'durum' => 'false',
            'text' => 'Kategori silinirken bir hata oluştu.'
        ];
    }
} else {
    $_SESSION['message'] = [
        'durum' => 'false',
        'text' => 'Geçersiz kategori ID.'
    ];
}

header("Location: ../kategoridel.php");
exit();
