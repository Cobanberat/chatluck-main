<?php
include "../connect/db.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $kategoriID = $_GET['id'];

    $stmt = $conn->prepare("SELECT id, name, ust FROM parent WHERE id = :id");
    $stmt->bindParam(':id', $kategoriID, PDO::PARAM_INT);
    $stmt->execute();

    $kategori = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($kategori) {
        echo json_encode($kategori);
    } else {
        // Eğer kategori bulunamazsa hata mesajı gönderilir
        echo json_encode(['error' => 'Kategori bulunamadı.']);
    }
} else {
    // ID parametresi yoksa hata mesajı gönderilir
    echo json_encode(['error' => 'Geçersiz kategori ID.']);
}
?>
