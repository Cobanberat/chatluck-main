<?php
include "../connect/db.php";

if (isset($_GET['id'])) {
    $oyunID = $_GET['id'];

    // Seçilen oyunun bilgilerini veritabanından çek
    $stmt = $conn->prepare("SELECT * FROM oyun WHERE id = :id");
    $stmt->execute(['id' => $oyunID]);
    $oyun = $stmt->fetch(PDO::FETCH_ASSOC);

    // Hata kontrolü için
    if ($oyun) {
        echo json_encode($oyun); // Veriyi JSON olarak döndür
    } else {
        echo json_encode(['error' => 'Veri bulunamadı']);
    }
} else {
    echo json_encode(['error' => 'ID parametresi eksik']);
}
