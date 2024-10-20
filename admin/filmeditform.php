<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$filmler = $conn->query("SELECT * FROM film")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Film Düzenle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Film Düzenle</h6>

                <div class="mb-3">
                    <label for="filmSelect" class="form-label">Film Seç</label>
                    <select class="js-example-basic-single form-select" id="filmSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir film seçin</option>
                        <?php foreach ($filmler as $film): ?>
                            <option value="<?= $film['id'] ?>"><?= $film['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="filmForm" method="post" action="form/filmedit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="filmID">
                    <div class="mb-3">
                        <label for="filmName" class="form-label">Film İsmi</label>
                        <input type="text" name="name" class="form-control" id="filmName" autocomplete="off" placeholder="Film İsmi">
                    </div>
                    <div class="mb-3">
                        <label for="filmInfo" class="form-label">Film Bilgi</label>
                        <textarea name="info" class="form-control" id="filmInfo" placeholder="Film Bilgisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="filmImg">Film Kapak Resmi</label>
                        <input class="form-control" name="img" type="file" id="filmImg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Film Çıkış Tarihi</label>
                        <input class="form-control" name="date" id="filmDate" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy" placeholder="Film Çıkış Tarihi">
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
        $('#filmSelect').select2({
            placeholder: 'Film Ara',
            allowClear: true
        });


        $('#filmForm').submit(function(e) {
            var filmID = $('#filmSelect').val();
            if (!filmID) { 
                e.preventDefault();
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen Film Seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });


        $('#filmSelect').change(function() {
            var filmID = $(this).val();
            if (filmID) {

                $.get('getFilmData.php', { id: filmID }, function(data) {
                    var film = JSON.parse(data);
                    $('#filmID').val(film.id);
                    $('#filmName').val(film.name);
                    $('#filmInfo').val(film.info);
                    $('#filmDate').val(film.date);
                    updateOneCikarButton(film.id, film.durum);
                });
            }
        });

        // Öne Çıkar butonuna tıklama işlemi
        $('#oneCikar').click(function() {
            var filmID = $('#filmID').val();
            if (filmID) {
                $.post('updateFilmDurum.php', { id: filmID }, function(response) {
                    if (response.success) {
                        var yeniDurum = response.newStatus;
                        updateOneCikarButton(filmID, yeniDurum);
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
        function updateOneCikarButton(filmID, durum) {
            if (durum == 1) {
                $('#oneCikar').text('Öne Çıkarmadan Kaldır');
            } else {
                $('#oneCikar').text('Öne Çıkar');
            }
        }
    });
</script>

<?php include "footer.php"; ?>
