<?php
session_start();
include "../../connect/db.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategoriID = isset($_POST['id']) ? $_POST['id'] : null;
    $kategoriName = isset($_POST['name']) ? $_POST['name'] : null;
    $kategoriUst = isset($_POST['ust']) ? $_POST['ust'] : null;

    if ($kategoriID && $kategoriName) {
        $sorgu = $conn->prepare("UPDATE parent SET name = :name, ust = :ust WHERE id = :id");
        $sorgu->bindParam(':name', $kategoriName, PDO::PARAM_STR);
        $sorgu->bindParam(':ust', $kategoriUst, PDO::PARAM_INT);
        $sorgu->bindParam(':id', $kategoriID, PDO::PARAM_INT);

        if ($sorgu->execute()) {
            $_SESSION['message'] = [
                'durum' => 'true',
                'text' => 'Kategori başarıyla güncellendi.'
            ];
            header("Location: ../kategoriEditForm.php");
        } else {
            $_SESSION['message'] = [
                'durum' => 'false',
                'text' => 'Kategori güncellenirken bir hata oluştu.'
            ];
            header("Location: ../kategoriEditForm.php");
        }
    } else {
        $_SESSION['message'] = [
            'durum' => 'false',
            'text' => 'Lütfen gerekli alanları doldurunuz.'
        ];
        header("Location: ../kategoriEditForm.php");
    }

} else {
    header("Location: ../kategoriEditForm.php");
    exit();
}
