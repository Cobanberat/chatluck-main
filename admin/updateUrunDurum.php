<?php
session_start();
include "../connect/db.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Ürün durumunu kontrol et
    $sorgu = $conn->prepare("SELECT durum FROM urun WHERE id = :id");
    $sorgu->bindParam(":id", $id, PDO::PARAM_INT);
    $sorgu->execute();
    $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($urun) {
        // Mevcut durumu tersine çevir (0 -> 1, 1 -> 0)
        $yeniDurum = $urun['durum'] == 1 ? 0 : 1;

        // Durumu güncelle
        $updateSorgu = $conn->prepare("UPDATE urun SET durum = :durum WHERE id = :id");
        $updateSorgu->bindParam(":durum", $yeniDurum, PDO::PARAM_INT);
        $updateSorgu->bindParam(":id", $id, PDO::PARAM_INT);
        
        if ($updateSorgu->execute()) {
            echo json_encode([
                "success" => true,
                "newStatus" => $yeniDurum
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Durum güncellenirken bir hata oluştu"
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Ürün bulunamadı"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Geçersiz istek"
    ]);
}
?>
