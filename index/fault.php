<?php include "header.php"; ?>
<?php include "../message/toast.php"; ?>
<section class="with-bg solid-section">
    <div class="fix-image-wrap" data-image-src="./assets/images/service/harddrive.jpg" data-parallax="scroll"></div>
    <div class="theme-back"></div>
    <div class="container page-info">
        <div class="section-alt-head container-md">
            <h1 class="section-title text-upper text-lg" data-inview-showup="showup-translate-right">ARIZA BİLDİR</h1>
            <p data-inview-showup="showup-translate-left">Arızanı Bildir, Hemen Halledelim</p>
        </div>
    </div>
    <div class="section-footer">
        <div class="container" data-inview-showup="showup-translate-down">
            <ul class="page-path">
                <li><a href="index.php">Ana Sayfa</a></li>
                <li class="path-separator"><i class="fas fa-chevron-right" aria-hidden="true"></i></li>
                <li>Arıza Bildir</li>
            </ul>
        </div>
    </div>
</section>

<section class="content-section" style="background-color: #f7f7f7; padding: 40px 0;"> <!-- Arka planı daha yumuşak bir gri ton yaptık -->
    <div class="container">
        <div class="section-head text-center container-md">
            <h2 class="section-title text-upper text-lg" data-inview-showup="showup-translate-right" style="font-size: 28px;">Arıza Bildirme Formu</h2> <!-- Yazı boyutunu büyüttük -->
            <p data-inview-showup="showup-translate-left" style="font-size: 16px;">Lütfen arızanızı aşağıdaki formu doldurarak bize bildirin.</p>
        </div>
        <div class="form-container medium-container">
            <form class="ariza-bildirim-form" action="../form/ariza.php" method="POST">
                <div class="row justify-content-center">
                    <!-- Sol Taraf: Cihaz Türü, Marka ve Model -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cihaz_turu" style="font-size: 16px;">Cihaz Türü</label> <!-- Yazı boyutunu büyüttük -->
                            <select class="form-control" name="cihaz_turu" required style="padding: 10px; border: 1px solid #ccc; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);"> <!-- Gölgeler eklendi -->
                                <option value="">Cihaz Türünü Seçin</option>
                                <option value="telefon">Telefon</option>
                                <option value="tablet">Tablet</option>
                                <option value="yazici">Yazıcı</option>
                                <option value="oyun_konsolu">Oyun Konsolu</option>
                                <option value="pc">PC</option>
                                <option value="diger">Diğer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="marka" style="font-size: 16px;">Cihaz Markası</label>
                            <input class="form-control" type="text" name="marka" placeholder="Cihaz Markası" required style="padding: 10px; border: 1px solid #ccc; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);">
                        </div>

                        <div class="form-group">
                            <label for="model" style="font-size: 16px;">Cihaz Modeli (Varsa)</label>
                            <input class="form-control" type="text" name="model" placeholder="Cihaz Modeli" style="padding: 10px; border: 1px solid #ccc; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ariza" style="font-size: 16px;">Arıza Açıklaması</label>
                            <textarea class="form-control" name="ariza" rows="6" placeholder="Arıza Nedir?" required style="padding: 10px; border: 1px solid #ccc; box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Formu Gönder Butonu -->
                <div class="text-center mt-4">
                    <?php if (isset($_SESSION["user"])) { ?>
                        <button class="btn btn-primary  text-upper" type="submit" style="padding: 0px 30px; font-size: 16px;">Arıza Bildir</button> <!-- Düğmenin boyutunu artırdık -->
                    <?php } else { ?>
                        <a href="../login/login.php" class="btn btn-primary  text-upper" type="submit" style="padding: 0px 30px; font-size: 16px;">Giriş Yap</a> <!-- Düğmenin boyutunu artırdık -->
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</section>

<a href="#" class="scroll-top disabled"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
<div class="loader-block">
    <div class="loader-back alt-bg"></div>
    <div class="loader-image"><img class="image" src="assets/images/parts/loader.gif" alt=""></div>
</div>
<?php include "footer.php"; ?>
<style>
    /* Arıza Bildirimi Formu */
    .form-container {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        color: #333;
        background-color: #fafafa;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
        border-color: #007bff;
        background-color: #ffffff;
        outline: none;
    }

    textarea {
        resize: vertical;
        /* Sadece dikey boyutlandırma izni */
        height: 120px;
    }

    /* Submit Button */
    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
        width: 100%;
        /* Tam genişlikte buton */
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>