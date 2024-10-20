<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

// Ürünleri ve kategorileri getir
$urunler = $conn->query("SELECT * FROM urun")->fetchAll(PDO::FETCH_ASSOC);
$kategoriler = $conn->query("SELECT * FROM parent")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ürün Düzenle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Ürün Düzenle</h6>

                <div class="mb-3">
                    <label for="urunSelect" class="form-label">Ürün Seç</label>
                    <select class="js-example-basic-single form-select" id="urunSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir ürün seçin</option>
                        <?php foreach ($urunler as $urun): ?>
                            <option value="<?= $urun['id'] ?>"><?= $urun['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="urunForm" method="post" action="form/urunedit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="urunID">
                    <div class="mb-3">
                        <label for="urunName" class="form-label">Ürün İsmi</label>
                        <input type="text" name="name" class="form-control" id="urunName" autocomplete="off" placeholder="Ürün İsmi">
                    </div>
                    <div class="mb-3">
                        <label for="urunInfo" class="form-label">Ürün Bilgi</label>
                        <textarea name="info" class="form-control" id="urunInfo" placeholder="Ürün Bilgisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="urunParent" class="form-label">Ürün Kategorisi</label>
                        <select name="parent" class="js-example-basic-single form-select" id="urunParent" style="background:#172340; width: 100%;">
                            <option value="" selected disabled>Kategori Seçin</option>
                            <?php foreach ($kategoriler as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="urunImg">Ürün Kapak Resmi</label>
                        <input class="form-control" name="img" type="file" id="urunImg">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                    <button type="button" class="btn btn-primary me-2" id="oneCikar">Öne Çıkar</button>
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

        $('#urunForm').submit(function(e) {
            var urunID = $('#urunSelect').val();
            if (!urunID) {
                e.preventDefault();
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen Ürün Seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        $('#urunSelect').change(function() {
            var urunID = $(this).val();
            if (urunID) {
                $.get('getUrunData.php', { id: urunID }, function(data) {
                    var urun = JSON.parse(data);
                    $('#urunID').val(urun.id);
                    $('#urunName').val(urun.name);
                    $('#urunInfo').val(urun.info);
                    $('#urunParent').val(urun.parent).trigger('change'); // Kategori seçimini güncelle
                    updateOneCikarButton(urun.id, urun.durum);
                });
            }
        });

        // Öne Çıkar butonuna tıklama işlemi
        $('#oneCikar').click(function() {
            var urunID = $('#urunID').val();
            if (urunID) {
                $.post('updateUrunDurum.php', { id: urunID }, function(response) {
                    if (response.success) {
                        var yeniDurum = response.newStatus;
                        updateOneCikarButton(urunID, yeniDurum);
                    } else {
                        iziToast.show({
                            title: "Hata",
                            message: "Bir hata oluştu!",
                            position: 'topRight',
                            backgroundColor: '#830000',
                            theme: 'light'
                        });
                    }
                }, 'json');
            }
        });

        // Öne çıkar butonunun metnini güncelle
        function updateOneCikarButton(urunID, durum) {
            if (durum == 1) {
                $('#oneCikar').text('Öne Çıkarmadan Kaldır');
            } else {
                $('#oneCikar').text('Öne Çıkar');
            }
        }
    });
</script>

<?php include "footer.php"; ?>
