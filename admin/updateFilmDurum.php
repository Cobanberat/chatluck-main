<?php
session_start();
include "../connect/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    $stmt = $conn->prepare("SELECT durum FROM film WHERE id = ?");
    $stmt->execute([$id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($film) {
        $yeniDurum = $film['durum'] == 1 ? 0 : 1;

        $stmt = $conn->prepare("UPDATE film SET durum = ? WHERE id = ?");
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
