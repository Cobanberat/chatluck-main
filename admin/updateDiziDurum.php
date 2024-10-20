<?php
session_start();
include "../connect/db.php";

if (isset($_POST['id'])) {
    $diziID = $_POST['id'];

    // Dizinin mevcut durumunu kontrol et
    $stmt = $conn->prepare("SELECT durum FROM dizi WHERE id = :id");
    $stmt->execute(['id' => $diziID]);
    $dizi = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dizi) {
        // Mevcut duruma göre durumu değiştir
        $yeniDurum = ($dizi['durum'] == 1) ? 0 : 1;

        // Durumu güncelle
        $updateStmt = $conn->prepare("UPDATE dizi SET durum = :durum WHERE id = :id");
        $updateStmt->execute(['durum' => $yeniDurum, 'id' => $diziID]);

        // Başarı mesajı gönder
        echo json_encode(['success' => true, 'newStatus' => $yeniDurum]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Dizi bulunamadı!']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Geçersiz istek!']);
}
