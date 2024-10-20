<?php
session_start();
include "../connect/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ürünü veritabanından seç
    $sorgu = $conn->prepare("SELECT * FROM urun WHERE id = :id");
    $sorgu->bindParam(":id", $id, PDO::PARAM_INT);
    $sorgu->execute();
    $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($urun) {
        // Ürün bilgilerini JSON formatında döndür
        echo json_encode($urun);
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
