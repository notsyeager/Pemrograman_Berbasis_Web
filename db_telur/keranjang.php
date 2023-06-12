
<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
  echo"<script>alert('keranjang kosong silahkan berbelanja dahulu');</script>";
  echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>keranjang belanja</title>
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
<section class="konten">
  <div class="container">
    <h1>Keranjang Belanja<h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subharga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor=1; ?>
        <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
        <?php
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $pecah = $ambil->fetch_assoc();
        $subharga = $pecah["harga_produk"]*$jumlah;
        ?>
        <tr>
          <td><?php echo $nomor; ?></td>
          <td><?php echo $pecah["nama_produk"]; ?></td>
          <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
          <td><?php echo $jumlah; ?></td>
          <td>Rp. <?php echo number_format($subharga); ?></td>
          <td>
            <a href="hapus.php?id=<?php echo $id_produk ?>"class="btn btn-danger btn-xs">hapus</a>
          </td>       
        </tr>
        <?php $nomor++; ?>
        <?php endforeach ?>
      </tbody>
    </table>
    <a href="index.php" class="btn btn-success">Lanjut Belanja</a>
    <a href="checkout.php" class="btn btn-primary">Checkout</a>
  </div>  
</section>
</body>
</html>


</body>
</html>