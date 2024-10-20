<?php
include "header.php";
include "../connect/db.php"; 

$category = isset($_GET['list']) ? $_GET['list'] : 'tum_urunler';

$columns = [];
switch($category) {
    case 'oyunlar':
        $title = "Oyunlar";
        $table = "oyun";
        $columns = ['ID', 'İsim', 'Bilgi', 'Tür', 'Resim', 'Durum'];
        break;

    case 'diziler':
        $title = "Diziler";
        $table = "dizi";
        $columns = ['ID', 'İsim', 'Bilgi', 'Tür', 'Resim', 'Durum'];
        break;

    case 'filmler':
        $title = "Filmler";
        $table = "film";
        $columns = ['ID', 'İsim', 'Bilgi', 'Tür', 'Resim', 'Durum'];
        break;

    case 'urunler':
        $title = "Ürünler";
        $table = "urun";
        $columns = ['ID', 'İsim', 'Bilgi', 'parent_id', 'Resim', 'Durum'];
        break;

    case 'kategoriler':
        $title = "Kategoriler";
        $table = "parent";
        $columns = ['ID', 'İsim', 'üst', '', '','','']; 
        break;

    default:
        $title = "Veri Bulunamadı";
        $table = '';
        break;
}

if ($table) {
    if ($category == 'kategoriler') {
        $query = "SELECT id, name as 'İsim', ust as 'üst' FROM $table";
    } else if ($category == 'urunler') {
        $query = "SELECT id, name as 'İsim', info as 'Bilgi', parent_id as 'Parent ID', img as 'Resim', durum as 'Durum' FROM $table";
    } else {
        $query = "SELECT id, name as 'İsim', info as 'Bilgi', tur as 'Tür', img as 'Resim', durum as 'Durum' FROM $table";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $data = [];
}
?>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Listeler</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"><?= $title ?></h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <?php if (!empty($columns)) : ?>
                                    <?php foreach ($columns as $column) : ?>
                                        <th><?= $column ?></th>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <th>Veri bulunamadı.</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)) : ?>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <?php foreach ($row as $cell) : ?>
                                            <td><?= htmlspecialchars($cell) ?></td>
                                        <?php endforeach; ?>
                                        <?php if($category == 'kategoriler'){ ?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php }else{ ?>
                                    <?php } ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="<?= count($columns) ?>">Veri bulunamadı.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
