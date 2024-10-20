<?php
session_start();
include "header.php";
include "../message/toast.php";

?>
      <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Form</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Oyun Ekle</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Oyun Ekle</h6>

                            <form class="forms-sample" action="form/oyunadd.php" method="post"  enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Oyun İsmi</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="İsim">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Oyun Bilgi</label>
                                    <textarea type="email" name="info" class="form-control" id="exampleInputEmail1" placeholder="Bilgi"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Oyun Türü</label>
                                    <input type="text" name="tür" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Tür">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="formFile">Oyun Kapak Resmi</label>
                                    <input class="form-control" name="img" type="file" id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Oyun Çıkış Tarihi</label>
                                    <input class="form-control" name="date" data-inputmask="'alias': 'datetime'" data-inputmask-placeholder="*" data-inputmask-inputformat="yyyy">
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Ekle</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php include "footer.php" ?>