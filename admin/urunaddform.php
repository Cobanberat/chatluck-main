<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$kategoriler = $conn->query("SELECT id, name FROM parent")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ürün Ekle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ürün Ekle</h6>
                <form method="post" action="form/urunadd.php" class="forms-sample" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Ürün İsmi</label>
                        <input type="text" name="name" class="form-control" id="productName" autocomplete="off" placeholder="İsim" required>
                    </div>
                    <div class="mb-3">
                        <label for="productInfo" class="form-label">Ürün Bilgisi</label>
                        <textarea name="info" class="form-control" id="productInfo" placeholder="Bilgi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Ürün Kategorisi</label>
                        <select name="parent" id="categorySelect" class="js-example-basic-single form-select" data-width="100%" required>
                            <option value="" disabled selected>Kategori Seçin</option>
                            <?php foreach ($kategoriler as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Ürün Kapak Resmi</label>
                        <input name="img" class="form-control" type="file" id="productImage" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Ekle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>