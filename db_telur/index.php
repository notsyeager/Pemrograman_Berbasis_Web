<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Penjualan Telur</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="Maxim/assets/img/favicon.png" rel="icon">
  <link href="Maxim/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Maxim/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="Maxim/assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
<?php include 'menu.php'?>

</body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to Maxim</h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

   
  </main><!-- End #main -->

<section class="konten">
  <div class="container">
    <h1>Produk Telur </h1>
    <div class="row">

      <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
      <?php while($perproduk = $ambil->fetch_assoc()){ ?>
      <div class="col-md-3">
        <div class="thumbnail">
          <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" width = "250">
          <div class="caption">
            <h3><?php echo $perproduk['nama_produk']; ?></h3>
            <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
            <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-warning">Detail</a>
          </div>
          <br>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>
   
 </section>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="Maxim/assets/vendor/aos/aos.js"></script>
  <script src="Maxim/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Maxim/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="Maxim/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="Maxim/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="Maxim/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>