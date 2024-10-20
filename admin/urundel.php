<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

// Ürünleri veritabanından al
$urunler = $conn->query("SELECT * FROM urun")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ürün Sil</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ürün Sil</h6>

                <form id="urunDeleteForm" method="post" action="form/urundelete.php" class="forms-sample">
                    <div class="mb-3">
                        <label for="urunSelect" class="form-label">Silinecek Ürün Seç</label>
                        <select class="js-example-basic-single form-select" id="urunSelect" name="id" style="background:#172340; width: 100%;">
                            <option value="" selected disabled>Bir ürün seçin</option>
                            <?php foreach ($urunler as $urun): ?>
                                <option value="<?= $urun['id'] ?>"><?= $urun['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">sil</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#urunSelect').select2({
            placeholder: 'Ürün Ara',
            allowClear: true
        });

        $('#urunDeleteForm').submit(function(e) {
            var urunID = $('#urunSelect').val();
            if (!urunID) {
                e.preventDefault();
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen Silinecek Ürün Seçin!",
                    position: 'topRight',
                    backgroundColor: '#830000',
                    theme: 'light'
                });
            } else {
                if (!confirm("Bu ürünü silmek istediğinize emin misiniz?")) {
                    e.preventDefault(); 
                }
            }
        });
    });
</script>

<?php include "footer.php"; ?>
