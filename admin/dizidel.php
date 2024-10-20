<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$diziler = $conn->query("SELECT * FROM dizi")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dizi Sil</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Dizi Sil</h6>

                <div class="mb-3">
                    <label for="diziSelect" class="form-label">Dizi Seç</label>
                    <select class="js-example-basic-single form-select" id="diziSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir Dizi seçin</option>
                        <?php foreach ($diziler as $dizi): ?>
                            <option value="<?= $dizi['id'] ?>"><?= $dizi['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="diziForm" method="post" action="form/dizidelete.php">
                    <input type="hidden" name="id" id="diziID">
                    <button type="submit" class="btn btn-primary me-2">Sil</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#diziSelect').select2({
            placeholder: 'Dizi Ara',
            allowClear: true
        });

        $('#diziForm').submit(function(e) {
            var filmID = $('#diziSelect').val(); 
            if (!filmID) { 
                e.preventDefault(); 
                iziToast.show({
                    title: "Hata",
                    message: "Lütfen bir Dizi seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        $('#diziSelect').change(function() {
            var filmID = $(this).val();
            if (filmID) {
                $.get('getDiziData.php', {
                    id: filmID
                }, function(data) {
                    var film = JSON.parse(data);
                    $('#diziID').val(film.id);
                });
            }
        });
    });
</script>

<?php include "footer.php"; ?>
