<?php session_start(); ?>
<?php include "../connect/db.php"; ?>
<?php if (!empty($_SESSION["user"])) { ?>
<?php $kullanicilar = $conn->query("select * from kullanicilar where id = '" . $_SESSION['user']['user_id'] . "'")->fetch(PDO::FETCH_ASSOC);
} ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>CH@TLUCK - Bilgisayar & Mobil Telefon Tamir Servisi</title>
    <link href="assets/animate.css/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css?family=Raleway:400,500,600,700" rel="stylesheet">
    <link href="../css-1?family=Montserrat:300,400,500,600,800,900" rel="stylesheet">
    <link href="assets/chosen/chosen.min.css" rel="stylesheet" type="text/css">
    <link href="assets/jquery-ui-custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="assets/pentix/css/pentix.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pex-theme.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .textet {
            color: #ff3b00;
        }

        .logo a {
            font-size: 30px;
        }

        #side-menu {
            position: fixed;
            right: -250px;
            /* Başlangıçta gizli */
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #333;
            color: #fff;
            z-index: 1000;
            padding: 20px;
            transition: right 0.5s ease;
            /* Sağdan açılma için geçiş efekti */
        }

        #side-menu.open {
            right: 0;
            /* Açıldığında sağa kaydır */
        }

        #side-menu h2 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #ff3b00;
        }

        #side-menu .profile-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #444;
            border-radius: 5px;
        }

        #side-menu ul {
            list-style: none;
            padding: 0;
        }

        #side-menu ul li {
            margin: 10px 0;
        }

        #side-menu ul li a {
            color: white;
            text-decoration: none;
            display: block;
            /* Tüm alanı tıklanabilir yap */
            padding: 10px;
            /* İçerik için biraz boşluk */
            border-radius: 4px;
            /* Kenarları yuvarla */
        }

        #side-menu ul li a:hover {
            background-color: #555;
            /* Üzerine gelindiğinde arka plan rengi */
        }
    </style>
</head>
        
<body class="body loader-loading">
    <header class="header header-over">
        <input id="header-default" type="radio" class="collapse" checked="checked" name="siteheader">
        <input id="header-shown" type="radio" class="collapse" name="siteheader">
        <input id="header-hidden" type="radio" class="collapse" name="siteheader">

        <div class="infobar transparent bottom-separator xs-hidden">
            <div class="container">
                <div class="cols-list pull-left cols-md">
                    <div class="list-item"><span class="info-icon"><i class="fas fa-home" aria-hidden="true"></i></span>Kılınçarslan, Özlem, Tavaş Sk No:16, 42080, Selçuklu/Konya</div>
                    <div class="list-item"><span class="info-icon"><i class="fas fa-phone"></i></span>Tel: +90 533 023 4542</div>
                </div>
                <div class="cols-list pull-right cols-md socials">
                    <div class="list-item"><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></div>
                    <div class="list-item"><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></div>
                    <div class="list-item"><a href="#"><i class="fab fa-pinterest" aria-hidden="true"></i></a></div>
                    <div class="list-item"><a href="#"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a></div>
                    <div class="list-item"><a href="#"><i class="fab fa-dribbble" aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>

        <nav class="stick-menu menu-wrap simple line transparent">
            <div class="menu-container menu-row">
                <div class="logo"><a href="index.php">CH<span class="textet">@</span>TLUCK</a></div>
                <div class="header-toggler pull-right xs-shown">
                    <label class="header-shown-sign" for="header-hidden"><i class="fas fa-times" aria-hidden="true"></i></label>
                    <label class="header-hidden-sign" for="header-shown"><i class="fas fa-bars" aria-hidden="true"></i></label>
                </div>
                <div class="clearfix xs-shown"></div>
                <div class="menu">
                    <ul class="menu-items">
                        <li><a href="index.php">Ana Sayfa</a></li>
                        <li><a href="shop-category.php">Mağaza</a></li>
                        <li><a href="services.php">Teknik Servis</a></li>
                        <li><a href="fault.php">Arıza Bildir</a></li>
                        <li><a href="#">Dijital Medya</a>
                            <span class="toggle-icon"><i class="fas fa-chevron-down" aria-hidden="true"></i></span>
                            <ul class="left">
                                <li><a href="gamelist.php">Oyunlar</a></li>
                                <li><a href="movielist.php">Filimler</a></li>
                                <li><a href="serieslist.php">Diziler</a></li>
                            </ul>
                        </li>
                        <?php if (empty($_SESSION["user"])) { ?>
                            <li><a href="../login/login.php">Giriş Yap</a></li>
                        <?php } else { ?>
                            <li><a href="#" data-show-block="search"><i class="fas fa-search" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i id="profile-icon" class="bi bi-person-fill"></i></a></li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="line-right xs-hidden"></div>
                </div>
            </div>
        </nav>
    </header>

    <nav id="side-menu" class="side-menu">
        <ul>
            <?php if (isset($_SESSION["user"])): ?>
                <p><strong>İsim:</strong> <?= $_SESSION["user"]["name"] ?></p>
                <p><strong>Email:</strong> <?= $_SESSION["user"]["mail"] ?></p>
            <?php else: ?>
                <a href="../login/login.php">Giriş Yap</a>
            <?php endif; ?>

            <li><a href="profile.php">Profilim</a></li>
            <li><a href="settings.php">Ayarlar</a></li>
            <li><a href="about.php">Hakkında</a></li>
            <li><a href="unset.php">Çıkış Yap</a></li>
            <?php if (empty($kullanicilar["durum"]) == 0): ?>
                <li><a href="../admin/index.php">Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <script>
        document.getElementById("profile-icon").onclick = function(event) {
            event.preventDefault();
            var sideMenu = document.getElementById("side-menu");
            if (sideMenu.classList.contains("open")) {
                sideMenu.classList.remove("open");
            } else {
                sideMenu.classList.add("open");
            }
        };

        window.onclick = function(event) {
            var sideMenu = document.getElementById("side-menu");
            if (!sideMenu.classList.contains("open") || event.target !== document.getElementById("profile-icon")) {
                sideMenu.classList.remove("open");
            }
        };
    </script>
</body>


</html>
<?php include "../message/toast.php"; ?>