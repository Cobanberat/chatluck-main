<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$parent = $conn->query("SELECT * FROM parent")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kategori Düzenle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kategori Düzenle</h6>

                <div class="mb-3">
                    <label for="kategoriSelect" class="form-label">Kategori Seç</label>
                    <select class="js-example-basic-single form-select" id="kategoriSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir Kategori Seçin</option>
                        <?php foreach ($parent as $kategori): ?>
                            <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="kategoriForm" method="post" action="form/kategoriedit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="kategoriID">
                    <div class="mb-3">
                        <label for="kategoriName" class="form-label">Kategori İsmi</label>
                        <input type="text" name="name" class="form-control" id="kategoriName" autocomplete="off" placeholder="Kategori İsmi">
                    </div>
                    <div class="mb-3">
                        <label for="kategoriUst" class="form-label">Üst Kategori</label>
                        <select name="ust" class="form-select" id="kategoriUst" style="background:#172340;">
                            <option value="" selected disabled>Üst Kategori Seçin</option>
                            <?php foreach ($parent as $kategori): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kategoriSelect').select2({
            placeholder: 'Kategori Ara',
            allowClear: true
        });

        $('#kategoriForm').submit(function(e) {
            var kategoriID = $('#kategoriSelect').val();
            if (!kategoriID) {
                e.preventDefault();
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen Kategori Seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        $('#kategoriSelect').change(function() {
            var kategoriID = $(this).val();
            if (kategoriID) {
                $.get('getKategoriData.php', { id: kategoriID }, function(data) {
                    var kategori = JSON.parse(data);
                    $('#kategoriID').val(kategori.id);
                    $('#kategoriName').val(kategori.name);
                    $('#kategoriUst').val(kategori.ust);
                    updateOneCikarButton(kategori.id, kategori.durum);
                });
            }
        });


        function updateOneCikarButton(kategoriID, durum) {
            if (durum == 1) {
                $('#oneCikar').text('Öne Çıkarmadan Kaldır');
            } else {
                $('#oneCikar').text('Öne Çıkar');
            }
        }
    });
</script>

<?php include "footer.php"; ?>
