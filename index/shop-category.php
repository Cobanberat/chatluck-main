<?php
include "header.php";

// PDO bağlantısı
$conn = new PDO("mysql:host=localhost;dbname=chatluck", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Kategori ID'sini al
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$categoryIds = [$categoryId]; // Kategori ve alt kategorileri burada tutulacak

if ($categoryId) {
    // Kategori ve tüm alt kategorileri bul
    $childCategories = getAllChildCategories($conn, $categoryId);
    $categoryIds = array_merge($categoryIds, $childCategories);
}

// Sayfalama ayarları
$perPage = isset($_GET['show']) ? (int)$_GET['show'] : 8;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;

// Sıralama ayarları
$sortBy = isset($_GET['sortby']) ? $_GET['sortby'] : 'name';
$orderClause = '';
if ($sortBy == '1') {
    $orderClause = 'ORDER BY urun.created_at DESC'; // En yeniler
} elseif ($sortBy == '2') {
    $orderClause = 'ORDER BY urun.popularity DESC'; // En iyi eşleşme
} else {
    $orderClause = 'ORDER BY urun.name'; // Varsayılan sıralama: isim
}

// Ürünlerin toplam sayısını öğren ve kategoriye göre filtrele
$totalQuery = "SELECT COUNT(*) as total FROM urun";
if ($categoryId) {
    $totalQuery .= " WHERE parent_id IN (" . implode(',', array_fill(0, count($categoryIds), '?')) . ")";
}
$totalStmt = $conn->prepare($totalQuery);

if ($categoryId) {
    foreach ($categoryIds as $index => $id) {
        $totalStmt->bindValue($index + 1, $id, PDO::PARAM_INT); // Pozisyonel parametre kullan
    }
}
$totalStmt->execute();
$totalUrunler = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalUrunler / $perPage);

// Ürünleri çekme ve kategori filtresi uygulama
$query = "SELECT urun.id as urun_id, urun.name as urun_name, urun.img, urun.info, parent.id as kategori_id, parent.name as kategori_name
          FROM urun
          LEFT JOIN parent ON urun.parent_id = parent.id";
if ($categoryId) {
    $query .= " WHERE parent_id IN (" . implode(',', array_fill(0, count($categoryIds), '?')) . ")";
}
$query .= " $orderClause LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
if ($categoryId) {
    foreach ($categoryIds as $index => $id) {
        $stmt->bindValue($index + 1, $id, PDO::PARAM_INT); // Pozisyonel parametre kullan
    }
    // Limit ve Offset parametrelerini yalnızca kategori seçildiğinde ekleyin
    $stmt->bindValue(count($categoryIds) + 1, $perPage, PDO::PARAM_INT); // Limit parametresi
    $stmt->bindValue(count($categoryIds) + 2, $offset, PDO::PARAM_INT); // Offset parametresi
} else {
    // Kategori seçilmediğinde LIMIT ve OFFSET parametrelerini ekleyin
    $stmt->bindValue(1, $perPage, PDO::PARAM_INT); // Limit parametresi
    $stmt->bindValue(2, $offset, PDO::PARAM_INT); // Offset parametresi
}
$stmt->execute();
$urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kategorileri hiyerarşik olarak almak için fonksiyon

// Alt kategorileri bulma fonksiyonu (recursive)
function getAllChildCategories($conn, $categoryId) {
    $childCategories = [];
    $query = "SELECT id FROM parent WHERE ust = :category_id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        $childCategories[] = $row['id'];
        $childCategories = array_merge($childCategories, getAllChildCategories($conn, $row['id']));
    }

    return $childCategories;
}

// Üst kategorileri bulma fonksiyonu (recursive)
function getParentCategories($conn, $categoryId) {
    $parentCategories = [];
    while ($categoryId) {
        $query = $conn->prepare("SELECT ust FROM parent WHERE id = ?");
        $query->execute([$categoryId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result && $result['ust']) {
            $parentCategories[] = $result['ust'];
            $categoryId = $result['ust'];
        } else {
            break;
        }
    }
    return $parentCategories;
}

// Kategorileri listeleme fonksiyonu
function kategoriListele($conn, $ust_id = 0, $seviye = 0) {
    $query = "SELECT id, name FROM parent WHERE ust = :ust_id";
    $stmt = $conn->prepare($query);
    $stmt->execute(['ust_id' => $ust_id]);

    $kategoriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $currentCategoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

    // Açık kalması gereken tüm kategorileri bul (seçili kategori + alt ve üst kategorileri)
    $openCategories = [];
    if ($currentCategoryId) {
        $openCategories = array_merge(
            getParentCategories($conn, $currentCategoryId),
            getAllChildCategories($conn, $currentCategoryId),
            [$currentCategoryId]
        );
    }

    if (count($kategoriler) > 0) {
        foreach ($kategoriler as $kategori) {
            $isActive = in_array($kategori["id"], $openCategories) ? ' active' : '';

            echo '<li class="category-item' . $isActive . '">
                    <span class="category-line">
                        <a class="content-link" href="shop-category.php?category_id=' . $kategori["id"] . '">
                            <span class="single-line-text">' . str_repeat("-", $seviye) . ' ' . $kategori["name"] . '</span>
                        </a>
                        <a class="open-sub-link content-link" href="#">
                            <span class="shown-icon"><i class="fas fa-minus"></i></span>
                            <span class="hidden-icon"><i class="fas fa-plus"></i></span>
                        </a>
                    </span>';

            echo '<ul class="sub-categories-list" ' . ($isActive ? 'style="display:block;"' : '') . '>';
            kategoriListele($conn, $kategori['id'], $seviye + 1);
            echo '</ul>';

            echo '</li>';
        }
    }
}


?>


<section class="with-bg solid-section">
    <div class="fix-image-wrap" data-image-src="./assets/images/service/tools.jpg" data-parallax="scroll"></div>
    <div class="theme-back"></div>
    <div class="container page-info">
        <div class="section-alt-head container-md">
            <h1 class="section-title text-upper text-lg" data-inview-showup="showup-translate-right">Mağaza</h1>
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
            <!-- Sıralama ve Gösterme Seçenekleri Formu -->
            <form>
                <div class="row">
                    <div class="sm-col-6 md-col-4">
                        <div class="field-group shop-line-field chosen-field"><label>Sıralama</label>
                            <div class="field-wrap">
                                <select class="field-control" name="sortby" onchange="this.form.submit()">
                                    <option value="name" <?= ($sortBy == 'name') ? 'selected' : '' ?>>İsim</option>
                                    <option value="1" <?= ($sortBy == '1') ? 'selected' : '' ?>>En Yeniler</option>
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
                        Toplam <?= $totalUrunler ?> üründen <?= $offset + 1 ?> ile <?= min($offset + $perPage, $totalUrunler) ?> arası gösteriliyor
                    </div>
                </div>
            </form>

            <div class="row cols-md rows-md">
                <?php
                if (count($urunler) > 0) {
                    foreach ($urunler as $urun) {
                        echo '
                        <div class="md-col-6">
                            <div class="item shop-item shop-item-simple" data-inview-showup="showup-scale">
                                <div class="item-back"></div>
                                <a href="shop-item.php?id=' . $urun["urun_id"] . '" class="item-image responsive-1by1">
                                    <img class="p-5" src="../admin/resimler/' . $urun["img"] . '" alt="Ürün Resmi">
                                </a>
                                <div class="item-content shift-md">
                                    <div class="item-textes">
                                        <div class="item-title text-upper">
                                            <a href="shop-item.php?id=' . $urun["urun_id"] . '" class="content-link">' . htmlspecialchars($urun["urun_name"]) . '</a>
                                        </div>
                                        <div class="item-categories">
                                            <a href="shop-category.php?category_id=' . $urun["kategori_id"] . '" class="content-link">' . htmlspecialchars($urun["kategori_name"]) . '</a>
                                        </div>
                                    </div>
                                    <div class="item-prices">
                                        <div class="item-price">' . htmlspecialchars($urun["info"]) . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p>Ürün bulunamadı.</p>";
                }
                ?>
            </div>
<!-- Sayfalama -->
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

    <aside class="page-sidebar content-section">
        <section class="side-content-section" data-inview-showup="showup-translate-up">
            <h5 class="shift-sm offs-md">Ürün Kategorisi</h5>
            <ul class="categories-list text-medium solid-color">
                <?php kategoriListele($conn); ?>
            </ul>
        </section>
    </aside>
</div>

<?php include "footer.php"; ?>
<style>
.category-item {
    list-style: none;
}

.category-item .sub-categories-list {
    display: none;
}

.category-item.active .sub-categories-list {
    display: block !important;
}

/* Seçili kategoriye mavi renk verelim */
.category-item.active > .category-line > .content-link {
    font-weight: bold;
    color: #007bff; /* Bootstrap'in mavi tonu */
}

    
</style> 