<?php
session_start();
include "../connect/db.php"; // Veritabanı bağlantısı
include "header.php";
include "../message/toast.php";

// Kategorileri çekme
$kategoriler = $conn->query("SELECT * FROM parent")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kategori Sil</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kategori Sil</h6>

                <form method="post" action="form/kategoridelete.php">
                    <div class="mb-3">
                        <label for="kategoriSelect" class="form-label">Kategori Seç</label>
                        <select name="id" class="form-select" id="kategoriSelect" required>
                            <option value="" disabled selected>Bir kategori seçin</option>
                            <?php foreach ($kategoriler as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">sil</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
