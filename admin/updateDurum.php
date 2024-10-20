<?php
session_start();
include "../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    // Oyun ID'sini kontrol et
    $stmt = $conn->prepare("SELECT durum FROM oyun WHERE id = ?");
    $stmt->execute([$id]);
    $oyun = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($oyun) {
        $yeniDurum = $oyun['durum'] == 1 ? 0 : 1;

        // Durumu güncelle
        $stmt = $conn->prepare("UPDATE oyun SET durum = ? WHERE id = ?");
        $stmt->execute([$yeniDurum, $id]);

        echo json_encode([
            'success' => true,
            'newStatus' => $yeniDurum
        ]);
    } else {
        echo json_encode([
            'success' => false 
        ]);
    }
}
?>
