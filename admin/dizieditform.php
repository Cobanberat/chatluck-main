<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

// Tüm dizileri çek
$diziler = $conn->query("SELECT * FROM dizi")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dizi Düzenle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Dizi Düzenle</h6>

                <div class="mb-3">
                    <label for="diziSelect" class="form-label">Dizi Seç</label>
                    <select class="js-example-basic-single form-select" id="diziSelect" style="width: 100%;">
                        <option value="" selected disabled>Bir dizi seçin</option>
                        <?php foreach ($diziler as $dizi): ?>
                            <option value="<?= $dizi['id'] ?>"><?= $dizi['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="diziForm" method="post" action="form/diziedit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="diziID">
                    <div class="mb-3">
                        <label for="diziName" class="form-label">Dizi İsmi</label>
                        <input type="text" name="name" class="form-control" id="diziName" autocomplete="off" placeholder="Dizi İsmi">
                    </div>
                    <div class="mb-3">
                        <label for="diziInfo" class="form-label">Dizi Bilgi</label>
                        <textarea name="info" class="form-control" id="diziInfo" placeholder="Dizi Bilgisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="diziName" class="form-label">Dizi Tür</label>
                        <input type="text" name="tur" class="form-control" id="diziTur" autocomplete="off" placeholder="Dizi Tür">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="diziImg">Dizi Kapak Resmi</label>
                        <input class="form-control" name="img" type="file" id="diziImg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dizi Çıkış Tarihi</label>
                        <input class="form-control" name="date" id="diziDate" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy" placeholder="Dizi Çıkış Tarihi">
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
        $('#diziSelect').select2({
            placeholder: 'Dizi Ara',
            allowClear: true
        });

        $('#diziForm').submit(function(e) {
            var diziID = $('#diziSelect').val();
            if (!diziID) { 
                e.preventDefault();
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen Dizi Seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        $('#diziSelect').change(function() {
            var diziID = $(this).val();
            if (diziID) {
                $.get('getDiziData.php', { id: diziID }, function(data) {
                    var dizi = JSON.parse(data);
                    $('#diziID').val(dizi.id);
                    $('#diziName').val(dizi.name);
                    $('#diziInfo').val(dizi.info);
                    $('#diziTur').val(dizi.tur);
                    $('#diziDate').val(dizi.date);
                    updateOneCikarButton(dizi.id, dizi.durum);
                });
            }
        });

        $('#oneCikar').click(function() {
            var diziID = $('#diziID').val();
            if (diziID) {
                $.post('updateDiziDurum.php', { id: diziID }, function(response) {
                    if (response.success) {
                        var yeniDurum = response.newStatus;
                        updateOneCikarButton(diziID, yeniDurum);
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

        function updateOneCikarButton(diziID, durum) {
            if (durum == 1) {
                $('#oneCikar').text('Öne Çıkarmadan Kaldır');
            } else {
                $('#oneCikar').text('Öne Çıkar');
            }
        }
    });
</script>

<?php include "footer.php"; ?>
