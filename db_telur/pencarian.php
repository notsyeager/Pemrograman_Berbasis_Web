<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");

$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
While($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Pencarian Barang</title>
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

<!-- navbar -->

<body>
  <section class="banner"></section>
  <script type="text/javascript">
    window.addEventListener("scroll", function(){
      var header = document.querySelector("header");
      header.classList.toggle("sticky", window.scrollY > 0);
    })
  </script>
</body>

<?php include'menu.php' ?>


	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>
		
		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger">Produk <strong><?php echo $keyword ?></strong> tidak ditemukan</div>
		<?php endif ?>
		<div class="row">

			<?php foreach ($semuadata as $key => $value): ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive" width ="450">
					<div class="caption">
						<h3><?php echo $value["nama_produk"] ?> produk</h3>
						<h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
						<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>

		</div>
	</div>
</body>
</html>