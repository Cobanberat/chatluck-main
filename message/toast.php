<script src="../assets/vendors/sweetalert2/sweetalert2.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

<?php if (isset($_SESSION['message'])) { ?>
  <script>
    const message = <?php echo json_encode($_SESSION['message']); ?>;
    const { durum, text } = message;

    // iziToast
    iziToast.show({
      title: durum === "true" ? "başarılı" : "Hata",
      message: text,
      position: 'topRight',
      backgroundColor: durum === "true" ? '#015701' : '#830000',
      theme: 'dark',
    });

    <?php unset($_SESSION['message']); ?>
  </script>
<?php } ?>