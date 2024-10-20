<?php
session_start();
include "../connect/db.php";
include "header.php";
include "../message/toast.php";

$filmler = $conn->query("SELECT * FROM Film")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Film Sil</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Film Sil</h6>

                <div class="mb-3">
                    <label for="filmSelect" class="form-label">Film Seç</label>
                    <select class="js-example-basic-single form-select" id="filmSelect" style="background:#172340; width: 100%;">
                        <option value="" selected disabled>Bir Film seçin</option>
                        <?php foreach ($filmler as $film): ?>
                            <option value="<?= $film['id'] ?>"><?= $film['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <form id="filmForm" method="post" action="form/filmDelete.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="filmID">
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
                    message: "Lütfen bir Film seçin!",
                    position: 'topRight',
                    backgroundColor:'#830000',
                    theme: 'light'
                });
            }
        });

        $('#filmSelect').change(function() {
            var filmID = $(this).val();
            if (filmID) {
                $.get('getFilmData.php', {
                    id: filmID
                }, function(data) {
                    var film = JSON.parse(data);
                    $('#filmID').val(film.id);
                });
            }
        });
    });
</script>

<?php include "footer.php"; ?>
