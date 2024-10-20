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
        <li class="breadcrumb-item active" aria-current="page">Oyun sil</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Oyun Sil</h6>

                <div class="mb-3">
                    <label for="oyunSelect" class="form-label">Oyun Seç</label>
                    <select class="js-example-basic-single form-select" id="oyunSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir oyun seçin</option>
                        <?php foreach ($oyunlar as $oyun): ?>
                            <option value="<?= $oyun['id'] ?>"><?= $oyun['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="oyunForm" method="post" action="form/oyundelete.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="oyunID">
                            
                    <button type="submit" class="btn btn-primary me-2">sil</button>
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

        // Formu submit etmeden önce oyun seçili mi kontrol et
        $('#oyunForm').submit(function(e) {
            var oyunID = $('#oyunSelect').val(); // Seçilen oyun ID'sini al
            if (!oyunID) { // Eğer oyun seçilmediyse
                e.preventDefault(); // Formun gönderilmesini engelle
                iziToast.show({
                    title: "hata",
                    message: "lütfen Oyun Seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        // Oyun seçildiğinde bilgileri forma doldur
        $('#oyunSelect').change(function() {
            var oyunID = $(this).val();
            if (oyunID) {
                // Ajax ile oyun bilgilerini al
                $.get('getOyunData.php', {
                    id: oyunID
                }, function(data) {
                    var oyun = JSON.parse(data);
                    $('#oyunID').val(oyun.id);
                });
            }
        });
    });
</script>

<?php include "footer.php"; ?>