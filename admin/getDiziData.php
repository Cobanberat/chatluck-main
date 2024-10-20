<?php
session_start();
include "../connect/db.php";

if (isset($_GET['id'])) {
    $diziID = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM dizi WHERE id = :id");
    $stmt->execute(['id' => $diziID]);
    $dizi = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dizi) {
        echo json_encode($dizi);
    } else {
        echo json_encode(['error' => 'Dizi bulunamadı!']);
    }
} else {
    echo json_encode(['error' => 'Geçersiz istek!']);
}
