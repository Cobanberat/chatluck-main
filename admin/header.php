<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
  <meta name="author" content="NobleUI">
  <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  <title>CH@TLUCK</title>

  <!-- color-modes:js -->
  <script src="../assets/js/color-modes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
  <link rel="stylesheet" href="../assets/vendors/select2/select2.min.css">


  <link rel="stylesheet" href="../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="../assets/css/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- core:css -->
  <link rel="stylesheet" href="../assets/vendors/core/core.css">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/fonts/feather-font/css/iconfont.css">



  <link rel="stylesheet" href="../assets/css/style.css">


  <link rel="shortcut icon" href="../assets/images/favicon.png">

</head>

<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      CH<span>@</span>TLUCK
    </a>
    <div class="sidebar-toggler">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav" id="sidebarNav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="users.php" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kullanıcılar</span>
        </a>
      </li>
      <li class="nav-item nav-category">İŞLEM</li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
          <i class="link-icon" data-feather="target"></i>
          <span class="link-title">Oyun</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="emails">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="oyunaddform.php" type="submit" class="nav-link">Ekle</a>
            </li>
            <li class="nav-item">
              <a href="oyuneditform.php" class="nav-link">Düzenle</a>
            </li>
            <li class="nav-item">
              <a href="oyundel.php" class="nav-link">Sil</a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
          <i class="link-icon" data-feather="anchor"></i>
          <span class="link-title">Film</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="advancedUI">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="filmaddform.php" class="nav-link">Ekle</a>
            </li>
            <li class="nav-item">
              <a href="filmeditform.php" class="nav-link">Düzenle</a>
            </li>
            <li class="nav-item">
              <a href="filmdel.php" class="nav-link">Sil</a>
            </li>
          </ul>
        </div>
      </li>



      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
          <i class="link-icon" data-feather="inbox"></i>
          <span class="link-title">Dizi</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="forms">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="diziaddform.php" class="nav-link">Ekle</a>
            </li>
            <li class="nav-item">
              <a href="dizieditform.php" class="nav-link">Düzenle</a>
            </li>
            <li class="nav-item">
              <a href="dizidel.php" class="nav-link">Sil</a>
            </li>
          </ul>
        </div>
      </li>


        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#urun" role="button" aria-expanded="false" aria-controls="urun">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">ürün</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" data-bs-parent="#sidebarNav" id="urun">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="urunaddform.php" class="nav-link">Ekle</a>
              </li>
              <li class="nav-item">
                <a href="uruneditform.php" class="nav-link">Düzenle</a>
              </li>
              <li class="nav-item">
                <a href="urundel.php" class="nav-link">Sil</a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#kategori" role="button" aria-expanded="false" aria-controls="kategori">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">kategori</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" data-bs-parent="#sidebarNav" id="kategori">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="kategoriaddform.php" class="nav-link">Ekle</a>
              </li>
              <li class="nav-item">
                <a href="kategorieditform.php" class="nav-link">Düzenle</a>
              </li>
              <li class="nav-item">
                <a href="kategoridel.php" class="nav-link">Sil</a>
              </li>
            </ul>
          </div>
        </li>

      <li class="nav-item nav-category">Teknik</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
          <i class="link-icon" data-feather="feather"></i>
          <span class="link-title">Teknik Servis Bilgileri</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="uiComponents">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="../ui-components/accordion.html" class="nav-link">Accordion</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button" aria-expanded="false" aria-controls="charts">
          <i class="link-icon" data-feather="pie-chart"></i>
          <span class="link-title">İstatistikler</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="charts">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="statistics.php" class="nav-link">Tüm İstatistikler</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">Cihaz Takip</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="tables">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="waiting.php" class="nav-link">Tamir Bekleyen Cihazlar</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" role="button" aria-expanded="false" aria-controls="icons">
          <i class="link-icon" data-feather="smile"></i>
          <span class="link-title">Kategori</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="icons">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="category.php" class="nav-link">Tüm Kategoriler</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Ürün</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Listeler</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="general-pages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="product_list.php?list=urunler" class="nav-link">Ürünler</a>
            </li>
            <li class="nav-item">
              <a href="product_list.php?list=oyunlar" class="nav-link">Oyunlar</a>
            </li>
            <li class="nav-item">
              <a href="product_list.php?list=diziler" class="nav-link">Diziler</a>
            </li>
            <li class="nav-item">
              <a href="product_list.php?list=filmler" class="nav-link">Filmler</a>
            </li>
            <li class="nav-item">
              <a href="product_list.php?list=kategoriler" class="nav-link">Kategoriler</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#authPages" role="button" aria-expanded="false" aria-controls="authPages">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Düzenle</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="authPages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="../auth/login.html" class="nav-link">Login</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Değerlendirmeler</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#errorPages" role="button" aria-expanded="false" aria-controls="errorPages">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Yorumlar</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" data-bs-parent="#sidebarNav" id="errorPages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="../error/404.html" class="nav-link">404</a>
            </li>
            <li class="nav-item">
              <a href="../error/500.html" class="nav-link">500</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>

<nav class="navbar">
  <div class="navbar-content">

    <div class="logo-mini-wrapper">
      <img src="../assets/images/logo-mini-light.png" class="logo-mini logo-mini-light" alt="logo">
      <img src="../assets/images/logo-mini-dark.png" class="logo-mini logo-mini-dark" alt="logo">
    </div>

    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>

    <ul class="navbar-nav">
      <li class="theme-switcher-wrapper nav-item">
        <input type="checkbox" value="" id="theme-switcher">
        <label for="theme-switcher">
          <div class="box">
            <div class="ball"></div>
            <div class="icons">
              <i class="feather icon-sun"></i>
              <i class="feather icon-moon"></i>
            </div>
          </div>
        </label>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../assets/images/flags/us.svg" class="w-20px" title="us" alt="flag">
          <span class="ms-2 d-none d-md-inline-block">English</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="languageDropdown">
          <a href="javascript:;" class="dropdown-item py-2 d-flex"><img src="../assets/images/flags/us.svg" class="w-20px" title="us" alt="us"> <span class="ms-2"> English </span></a>
          <a href="javascript:;" class="dropdown-item py-2 d-flex"><img src="../assets/images/flags/fr.svg" class="w-20px" title="fr" alt="fr"> <span class="ms-2"> French </span></a>
          <a href="javascript:;" class="dropdown-item py-2 d-flex"><img src="../assets/images/flags/de.svg" class="w-20px" title="de" alt="de"> <span class="ms-2"> German </span></a>
          <a href="javascript:;" class="dropdown-item py-2 d-flex"><img src="../assets/images/flags/pt.svg" class="w-20px" title="pt" alt="pt"> <span class="ms-2"> Portuguese </span></a>
          <a href="javascript:;" class="dropdown-item py-2 d-flex"><img src="../assets/images/flags/es.svg" class="w-20px" title="es" alt="es"> <span class="ms-2"> Spanish </span></a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="grid"></i>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="appsDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p class="mb-0 fw-bold">Web Apps</p>
            <a href="javascript:;" class="text-secondary">Edit</a>
          </div>
          <div class="row g-0 p-1">
            <div class="col-3 text-center">
              <a href="../apps/chat.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i data-feather="message-square" class="icon-lg mb-1"></i>
                <p class="fs-12px">Chat</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="../apps/calendar.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i data-feather="calendar" class="icon-lg mb-1"></i>
                <p class="fs-12px">Calendar</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="../email/inbox.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i data-feather="mail" class="icon-lg mb-1"></i>
                <p class="fs-12px">Email</p>
              </a>
            </div>
            <div class="col-3 text-center">
              <a href="profile.html" class="dropdown-item d-flex flex-column align-items-center justify-content-center w-70px h-70px"><i data-feather="instagram" class="icon-lg mb-1"></i>
                <p class="fs-12px">Profile</p>
              </a>
            </div>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="mail"></i>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>9 New Messages</p>
            <a href="javascript:;" class="text-secondary">Clear all</a>
          </div>
          <div class="p-1">
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face2.jpg" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Leonardo Payne</p>
                  <p class="fs-12px text-secondary">Project status</p>
                </div>
                <p class="fs-12px text-secondary">2 min ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face3.jpg" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Carl Henson</p>
                  <p class="fs-12px text-secondary">Client meeting</p>
                </div>
                <p class="fs-12px text-secondary">30 min ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face4.jpg" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Jensen Combs</p>
                  <p class="fs-12px text-secondary">Project updates</p>
                </div>
                <p class="fs-12px text-secondary">1 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face5.jpg" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Amiah Burton</p>
                  <p class="fs-12px text-secondary">Project deatline</p>
                </div>
                <p class="fs-12px text-secondary">2 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face6.jpg" alt="userr">
              </div>
              <div class="d-flex justify-content-between flex-grow-1">
                <div class="me-4">
                  <p>Yaretzi Mayo</p>
                  <p class="fs-12px text-secondary">New record</p>
                </div>
                <p class="fs-12px text-secondary">5 hrs ago</p>
              </div>
            </a>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
          <div class="indicator">
            <div class="circle"></div>
          </div>
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
            <p>6 New Notifications</p>
            <a href="javascript:;" class="text-secondary">Clear all</a>
          </div>
          <div class="p-1">
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="gift"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>New Order Recieved</p>
                <p class="fs-12px text-secondary">30 min ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="alert-circle"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Server Limit Reached!</p>
                <p class="fs-12px text-secondary">1 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <img class="w-30px h-30px rounded-circle" src="../assets/images/faces/face6.jpg" alt="userr">
              </div>
              <div class="flex-grow-1 me-2">
                <p>New customer registered</p>
                <p class="fs-12px text-secondary">2 sec ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="layers"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Apps are ready for update</p>
                <p class="fs-12px text-secondary">5 hrs ago</p>
              </div>
            </a>
            <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
              <div class="w-30px h-30px d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="icon-sm text-white" data-feather="download"></i>
              </div>
              <div class="flex-grow-1 me-2">
                <p>Download completed</p>
                <p class="fs-12px text-secondary">6 hrs ago</p>
              </div>
            </a>
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="javascript:;">View all</a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="w-30px h-30px ms-1 rounded-circle" src="../assets/images/faces/face1.jpg" alt="profile">
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              <img class="w-80px h-80px rounded-circle" src="../assets/images/faces/face1.jpg" alt="">
            </div>
            <div class="text-center">
              <p class="fs-16px fw-bolder">Amiah Burton</p>
              <p class="fs-12px text-secondary">amiahburton@gmail.com</p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2">
              <a href="profile.html" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Edit Profile</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="repeat"></i>
                <span>Switch User</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="javascript:;" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>

  </div>
</nav>
<div class="main-wrapper">
  <div class="page-wrapper">
    <div class="page-content">