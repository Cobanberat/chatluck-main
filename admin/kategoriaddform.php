<?php
session_start();
include "header.php";
include "../message/toast.php";
include "../connect/db.php";
$kategoriler = $conn->query("select * from parent")->fetchAll(PDO::FETCH_ASSOC);
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Form</a></li>
        <li class="breadcrumb-item active" aria-current="page">ürün Ekle</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kategori Ekle</h6>
                <form method="post" action="form/kategoriadd.php" class="forms-sample" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Kategori İsmi</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="İsim">
                    </div>  
                    <div class="mb-3">
                        <label for="select2">üst kategorisi</label>
                        <select name="ust" id="select2" class="js-example-basic-single form-select" data-width="100%">
                            <option value="0" selected>yok</option>
                            <?php foreach ($kategoriler as $row): ?>
                                <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
                            <?php endforeach; ?>
                        </select>
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