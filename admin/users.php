<?php include "header.php"; ?>
<?php include "../connect/db.php"; ?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Listeler</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kullanıcılar</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kullanıcılar</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>surname</th>
                                <th>mail</th>
                                <th>username</th>
                                <th>durum</th>
                                <th>kayıt Tarihi</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kullanicilar as $row): ?>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td><?= $row["name"] ?></td>
                                <td><?= $row["surname"] ?></td>
                                <td><?= $row["mail"] ?></td>
                                <td><?= $row["username"] ?></td>
                                <td>
                                    <?php if($row["durum"] == 1){?>
                                        admin
                                   <?php  }else{ ?>
                                        kullanıcı
                                   <?php } ?>
                                </td>
                                <td><?= $row["created_at"] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>