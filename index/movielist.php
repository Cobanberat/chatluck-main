<?php
include "header.php";
include "../connect/db.php"; // Veritabanı bağlantısı

// Sayfalama ayarları
$perPage = isset($_GET['show']) ? (int)$_GET['show'] : 8; // Sayfa başına gösterilecek film sayısı, varsayılan 8
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Mevcut sayfa numarası, varsayılan 1
$offset = ($currentPage - 1) * $perPage; // Veritabanından başlayacak film sırası

// Toplam film sayısını öğren
$totalQuery = "SELECT COUNT(*) as total FROM film";
$stmt = $conn->prepare($totalQuery);
$stmt->execute();
$totalFilmler = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalFilmler / $perPage); // Toplam sayfa sayısı

// Filmleri veritabanından çek, sayfalama ile birlikte
$query = "SELECT id, name, info, tur, img, date FROM film LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$filmler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="with-bg solid-section">
    <div class="fix-image-wrap" data-image-src="./assets/images/service/tools.jpg" data-parallax="scroll"></div>
    <div class="theme-back"></div>
    <div class="container page-info">
        <div class="section-alt-head container-md">
            <h1 class="section-title text-upper text-lg" data-inview-showup="showup-translate-right">Filimler</h1>
        </div>
    </div>
    <div class="section-footer">
        <div class="container" data-inview-showup="showup-translate-down">
            <ul class="page-path">
                <li><a href="index.php">Ana Sayfa</a></li>
                <li class="path-separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></li>
                <li>Mağaza</li>
            </ul>
        </div>
    </div>
</section>

<div class="clearfix page-sidebar-right container">
    <div class="page-content">
        <section class="content-section">
            <form>
                <div class="row">
                    <div class="sm-col-6 md-col-4">
                        <div class="field-group shop-line-field chosen-field"><label>Sıralama</label>
                            <div class="field-wrap">
                                <select class="field-control" name="sortby">
                                    <option name="sortby">İsim</option>
                                    <option name="sortby" value="1">En Yeniler</option>
                                    <option name="sortby" value="2">En iyi eşleşme</option>
                                </select>
                                <span class="select-arrow"><i class="fas fa-chevron-down"></i></span>
                                <span class="field-back"></span>
                            </div>
                        </div>
                    </div>
                    <div class="sm-col-6 md-col-4">
                        <div class="field-group shop-line-field chosen-field"><label>Göster</label>
                            <div class="field-wrap">
                                <select class="field-control" name="show" onchange="this.form.submit()">
                                    <option name="show" value="4" <?= ($perPage == 4) ? 'selected' : '' ?>>4</option>
                                    <option name="show" value="8" <?= ($perPage == 8) ? 'selected' : '' ?>>8</option>
                                    <option name="show" value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                                    <option name="show" value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20</option>
                                </select>
                                <span class="select-arrow"><i class="fas fa-chevron-down"></i></span>
                                <span class="field-back"></span>
                            </div>
                        </div>
                    </div>
                    <div class="sm-col-12 md-col-4 md-text-right shop-results-text">
                        Toplam <?= $totalFilmler ?> filmden <?= $offset + 1 ?> ile <?= min($offset + $perPage, $totalFilmler) ?> arası gösteriliyor
                    </div>
                </div>
            </form>

            <div class="row cols-md rows-md">
                <?php if(!empty($filmler)): ?>
                    <?php foreach ($filmler as $film): ?>
                    <div class="md-col-6">
                        <div class="item shop-item shop-item-simple" data-inview-showup="showup-scale">
                            <div class="item-back"></div>
                            <a href="shop-item.html?id=<?= $film['id'] ?>" class="item-image responsive-1by1">
                                <img src="assets/images/shop/<?= htmlspecialchars($film['img']) ?>" alt="<?= htmlspecialchars($film['name']) ?>">
                            </a>
                            <div class="item-content shift-md">
                                <div class="item-textes">
                                    <div class="item-title text-upper">
                                        <a href="shop-item.html?id=<?= $film['id'] ?>" class="content-link"><?= htmlspecialchars($film['name']) ?></a>
                                    </div>
                                    <div class="item-categories">
                                        <span><?= htmlspecialchars($film['tur']) ?></span>
                                    </div>
                                    <div class="item-description">
                                        <p><?= htmlspecialchars($film['info']) ?></p>
                                    </div>
                                </div>
                                <div class="item-prices">
                                    <div class="item-price">Çıkış Tarihi: <?= htmlspecialchars($film['date']) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Hiç film bulunamadı.</p>
                <?php endif; ?>
            </div>

            <div class="text-center shift-lg" data-inview-showup="showup-translate-up">
                <div class="paginator">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>&show=<?= $perPage ?>" class="previous"><i class="fas fa-angle-left" aria-hidden="true"></i></a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>&show=<?= $perPage ?>" class="<?= ($i == $currentPage) ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>&show=<?= $perPage ?>" class="next"><i class="fas fa-angle-right" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include "footer.php"; ?>
