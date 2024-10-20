<?php
session_start();
include "../connect/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Film bilgilerini veritabanından çekiyoruz
    $stmt = $conn->prepare("SELECT * FROM film WHERE id = ?");
    $stmt->execute([$id]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($film) {
        echo json_encode([
            'id' => $film['id'],
            'name' => $film['name'],
            'info' => $film['info'],
            'img' => $film['img'],
            'date' => $film['date'],
            'durum' => $film['durum']
        ]);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
