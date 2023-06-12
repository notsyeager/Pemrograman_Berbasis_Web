<?php
session_start();
$koneksi = new mysqli("localhost","root","","db_telur");

$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

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

<section class="kontent">
	<div class="container">
		<br>
		<div class="row">
			<div class="col-md-6">
				<img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" class="img-responsive" width="500">
			</div>
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"] ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max = "<?php echo $detail ['stok_produk']?>">
							<div class = "input-grup-btn"></div>
						</div>
					</div>
					<div class="tombol">
						<button class="btn btn-primary" name="beli" style="margin-bottom: 50px;">Beli</button>
					</div>
				</form>
				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		<?php

		if (isset($_POST["beli"]))
		{
			$jumlah = $_POST["jumlah"];

			$_SESSION["keranjang"][$id_produk] = $jumlah;

			echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
			echo "<script>location='keranjang.php';</script>";
		}
		?>
	</div>
</section>
</body>
</html>