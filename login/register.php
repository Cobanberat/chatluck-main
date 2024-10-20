<?php session_start(); // Oturumu başlat ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <title>CH@TLUCK Kayıt Ol</title>
  <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css"> <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"> <!-- iziToast CSS -->
  <script src="../assets/js/color-modes.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="../css/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendors/core/core.css">
  <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>

<body>
  <div class="main-wrapper">
    <div class="page-wrapper full-page">
      <div class="page-content d-flex align-items-center justify-content-center">
        <div class="row w-100 mx-0 auth-page">
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div class="card">
              <div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">
                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="nobleui-logo d-block mb-2">CH<span>@</span>TLUCK</a>
                    <h5 class="text-secondary fw-normal mb-4">Hoşgeldin! Ücretsiz Kayıt Ol</h5>
                    <form class="forms-sample" id="registrationForm" action="../form/register.php" method="post">
                      <div class="mb-3">
                        <label for="name" class="form-label">İsim</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="İsim">
                      </div>
                      <div class="mb-3">
                        <label for="surname" class="form-label">Soy İsim</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Soy İsim">
                      </div>

                      <div class="mb-3">
                        <label for="username" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email Adresi</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre">
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Beni Hatırla
                        </label>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Kayıt Ol</button>
                      </div>
                      <a href="login.php" class="d-block mt-3 text-secondary">Hesabın Varmı? Giriş Yap</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
  <script src="../assets/vendors/core/core.js"></script>
  <script src="../assets/vendors/feather-icons/feather.min.js"></script>
  <script src="../assets/js/app.js"></script>
  <?php include "../message/toast.php"; ?>

 <script src="../assets/js/formerror.js"></script>
</body>
</html>
