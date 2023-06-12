<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Pembayaran</title>
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
<br>
<br>
<br>
<br>

<section class="riwayat">
    <div class="container">
      <h3>Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama_pelanggan']?></h3>

      <table class = "table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $nomor=1;
          // mendapatkan id_pelanggan yang login dari session
          $id_pelanggan = $_SESSION['pelanggan'] ['id_pelanggan'];

          $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
          while($pecah = $ambil->fetch_assoc()){

          ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['tanggal_pembelian'] ?></td>
            <td>
                <?php echo $pecah['status_pembelian']?>
                <br>
                <?php if (!empty($pecah['resi_pengiriman'])): ?>
                Resi: <?php echo $pecah['resi_pengiriman']; ?>
              <?php endif ?>
            </td>
            <td>Rp. <?php echo number_format($pecah['total_pembelian'])?></td>
            <td>
              <a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-danger">Nota</a>
              <?php if ($pecah ["status_pembelian"]=="pending"): ?>
              <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info">
              input Pembayaran
            </a>
          <?php else: ?>
            <a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" class=" btn btn-warning" >
              Lihat Pembayaaran
            </a>
          <?php endif ?>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php } ?>
        </tbody>
    </div>
</section>

</body>
</html>