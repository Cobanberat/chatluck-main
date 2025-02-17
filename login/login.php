﻿<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    
    <title>CH@TLUCK Giriş</title>
    
    <!-- color-modes:js -->
    <script src="../assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css"> <!-- SweetAlert2 CSS -->
    
  <!-- endinject -->
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="../assets/css/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  
	<!-- core:css -->
	<link rel="stylesheet" href="../assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->
  
	<!-- inject:css -->
	<link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->

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
                    <a href="../index/index.php" class="nobleui-logo d-block mb-2">CH<span>@</span>TLUCK</a>
                    <h5 class="text-secondary fw-normal mb-4">Tekrar Hoşgeldin! Hesabınıza Giriş Yapın</h5>
                    <form class="forms-sample" id="registrationForm" action="../form/login.php" method="post">
                      <div class="mb-3">
                        <label for="userEmail" class="form-label">Email adresi</label>
                        <input type="email" class="form-control" id="userEmail" name="email" placeholder="Email">
                      </div>
                      <div class="mb-3">
                        <label for="userPassword" class="form-label">Şifre</label>
                        <input type="password" class="form-control" name="password" id="userPassword" autocomplete="current-password" placeholder="Şifre">
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Beni Hatırla
                        </label>
                      </div>
                      <div>
                      <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Giriş</button>
                      </div>
                      <a href="register.php" class="d-block mt-3 text-secondary">Kullanıcı Değilmisin? Kayıt Ol</a>
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

	<!-- core:js -->
	<script src="../assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="../assets/vendors/feather-icons/feather.min.js"></script>
	<script src="../assets/js/app.js"></script>
	<!-- endinject -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
	<!-- Custom js for this page -->
  <script src="../assets/vendors/sweetalert2/sweetalert2.min.js"></script> <!-- SweetAlert2 JS -->
	<!-- End custom js for this page -->
  
<?php include "../message/toast.php"; ?>
<script src="../assets/js/formerror.js"></script>

</body>
</html>

