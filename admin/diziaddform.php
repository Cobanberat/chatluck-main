<?php
session_start();
include "header.php";
include "../message/toast.php"; ?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dizi Ekle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Dizi Ekle</h6>

                <form method="post" action="form/diziadd.php" class="forms-sample" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Dizi İsmi </label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1"
                            autocomplete="off" placeholder="İsim">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dizi Bilgi</label>
                        <textarea type="text" name="info" class="form-control" id="exampleInputEmail1"
                            placeholder="Bilgi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="select2">dizi türü</label>
                        <select name="tur" id="select2" class="js-example-basic-single form-select"
                            data-width="100%">
                            <option value="Aksiyon">Aksiyon</option>
                            <option value="dram">dram</option>
                            <option value="komedi">komedi</option>
                            <option value="romantik">romantik</option>
                            <option value="bilimkurgu">bilim kurgu</option>
                            <option value="bilimkurgu">Korku</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="formFile">Dizi Kapak Resmi</label>
                        <input name="img" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dizi Çıkış Tarihi</label>
                        <input name="date" class="form-control" data-inputmask="'alias': 'datetime'"
                            data-inputmask-placeholder="*" data-inputmask-inputformat="yyyy">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Ekle</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";

?>