<br>
<br>
<br>
<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();


if (empty($detbay))
{
	echo "<script>alert('belum ada data pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}


if ($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"])
{
	echo "<script>alert('anda tidak berhak melihat pembayaran')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Belanja</title>
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
<?php include 'menu.php'?>

<?php 
//echo "<pre>";
//print_r ($detbay);
//echo "</pre>";

?>
<br>
<div class="container">
	<h3>Lihat Pembayaran</h3>
	<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td><?php echo $detbay["nama"] ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $detbay["bank"] ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td><?php echo $detbay["tanggal"] ?></td>
				</tr>
				<tr>
					<th>Jumlah</th>
					<td>Rp. <?php echo number_format($detbay["jumlah"]) ?>,00</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive" width = "600">
		</div>
	</div>
</div>