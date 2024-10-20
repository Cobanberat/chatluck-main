<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$oyunlar = $conn->query("SELECT * FROM oyun")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Oyun Düzenle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Oyun Düzenle</h6>

                <div class="mb-3">
                    <label for="oyunSelect" class="form-label">Oyun Seç</label>
                    <select class="js-example-basic-single form-select" id="oyunSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir oyun seçin</option>
                        <?php foreach ($oyunlar as $oyun): ?>
                            <option value="<?= $oyun['id'] ?>"><?= $oyun['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Formun İçeriği ve Öne Çıkar Butonu -->
                <form id="oyunForm" method="post" action="form/oyunedit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="oyunID">
                    <div class="mb-3">
                        <label for="oyunName" class="form-label">Oyun İsmi</label>
                        <input type="text" name="name" class="form-control" id="oyunName" autocomplete="off" placeholder="Oyun İsmi">
                    </div>
                    <div class="mb-3">
                        <label for="oyunInfo" class="form-label">Oyun Bilgi</label>
                        <textarea name="info" class="form-control" id="oyunInfo" placeholder="Oyun Bilgisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="formFile">Oyun Kapak Resmi</label>
                        <input class="form-control" name="img" type="file" id="oyunImg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Oyun Çıkış Tarihi</label>
                        <input class="form-control" name="date" id="oyunDate" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy" placeholder="Oyun Çıkış Tarihi">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                    <button type="button" class="btn btn-primary me-2" id="oneCikar">Öne Çıkar</button>
                </form>


            </div>
        </div>
    </div>
</div>

<!-- jQuery ve Select2 Kütüphanesi -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#oyunSelect').select2({
        placeholder: 'Oyun Ara',
        allowClear: true
    });

    // Oyun seçildiğinde bilgileri forma doldur
    $('#oyunSelect').change(function() {
        var oyunID = $(this).val();
        if (oyunID) {
            $.get('getOyunData.php', { id: oyunID }, function(data) {
                var oyun = JSON.parse(data);
                $('#oyunID').val(oyun.id);
                $('#oyunName').val(oyun.name);
                $('#oyunInfo').val(oyun.info);
                $('#oyunDate').val(oyun.date);
                updateOneCikarButton(oyun.id, oyun.durum);
            });
        }
    });

    $('#oneCikar').click(function() {
        var oyunID = $('#oyunID').val();
        if (oyunID) {
            $.post('updateDurum.php', { id: oyunID }, function(response) {
                if (response.success) {
                    var yeniDurum = response.newStatus;
                    updateOneCikarButton(oyunID, yeniDurum);
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
    function updateOneCikarButton(oyunID, durum) {
        if (durum == 1) {
            $('#oneCikar').text('Öne Çıkarmadan Kaldır');
        } else {
            $('#oneCikar').text('Öne Çıkar');
        }
    }
});

</script>

<?php include "footer.php"; ?>