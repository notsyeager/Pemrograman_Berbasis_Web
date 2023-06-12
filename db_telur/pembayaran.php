<br>
<br>
<br>
<br>
<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
  echo "<script>alert('silahkan login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
}

$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_pelanggan_beli = $detpem["id_pelanggan"];
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli)
{
  echo "<script>alert('jangan nakal');</script>";
  echo "<script>location='riwayat.php';</script>";
  exit();
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Konfrimasi Pembayaran</title>
  <link href="Maxim/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="Maxim/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>
<body>
  <!-- ======= Header ======= -->
<?php include 'menu.php'?>



<div class="container">
  <h2>Konfirmasi Pembayaran</h2>
  <p>Kirim bukti pembayaran Anda disini</p>
  <div class="alert alert-info">total tagihan Anda <strong>RP. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>


  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama penyetor</label>
      <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
      <label>Bank</label>
      <input type="text" class="form-control" name="bank">      
    </div>
    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" class="from-control" name="jumlah" min="1">
    </div>
    <div class="form-group">
      <label>Foto Bukti</label>
      <input type="file" class="form-control" name="bukti">
      <p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
    </div>
    <button class="btn btn-primary" name="kirim">Kirim</button>
  </form>
</div>

<?php

if (isset($_POST["kirim"]))
{
  $namabukti = $_FILES["bukti"]["name"];
  $lokasibukti = $_FILES["bukti"]["tmp_name"];
  move_uploaded_file($lokasibukti, "bukti_pembayaran/$namabukti");

  $nama = $_POST["nama"];
  $bank = $_POST["bank"];
  $jumlah = $_POST["jumlah"];
  $tanggal = date("Y-m-d");

$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namabukti')");

$koneksi->query("UPDATE pembelian SET status_pembelian='sudah melakukan pembayaran' WHERE id_pembelian='$idpem'");


echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran');</script>";
echo "<script>location='riwayat.php';</script>";

}
?>

</body>
</html>