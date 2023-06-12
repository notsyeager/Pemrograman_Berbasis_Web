<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");


if (!isset($_SESSION["pelanggan"])) 
{
  echo "<script>alert('silahkan login');</script>";
  echo "<script>location='login.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Check Out</title>
      <!-- Vendor CSS Files -->
  <link href="Maxim/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="Maxim/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href= "css/checkout.css" rel="stylesheet">


    <!-- Template Main CSS File -->
  <link href="Maxim/assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- ======= Header ======= -->
<?php include 'menu.php'?>

<br>
<section class="konten">
  <div class="container">
    <h1>CheckOut</h1>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subharga</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor=1; ?>
        <?php $totalbelanja = 0; ?>
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
        </tr>
        <?php $nomor++; ?>
        <?php $totalbelanja+=$subharga; ?>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4">Total Belanja</th>
          <th>Rp. <?php echo number_format($totalbelanja) ?></th>
        </tr>
      </tfoot>
    </table>

<div class="cont">
  <form method="post">
  <div class="row">
    <div class="col-25">
      <label for="fname">Nama</label>
    </div>
    <div class="col-75">
      <input type="text" readonly id="fname" name="firstname" placeholder="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Telepon</label>
    </div>
    <div class="col-75">
      <input type="text" readonly id="lname" name="lastname" placeholder="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="country">Kota</label>
    </div>
    <div class="col-75">
      <select id="country" name="id_ongkir">
        <option value="">Pilih Ongkos kirim</option>
        <?php
        $ambil = $koneksi->query("SELECT * FROM ongkir");
        while ($perongkir = $ambil->fetch_assoc()) {
        ?>
        <option value="<?php echo $perongkir["id_ongkir"] ?>">
          <?php echo $perongkir['nama_kota'] ?> -
          Rp. <?php echo number_format($perongkir['tarif'])?>
        </option>
        <?php }?>
      </select>
    </div>
  </div>

      <div class="form-group">
        <label>Alamat Lengkap Pengiriman</label>
        <textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman dan kode pos"></textarea>
      </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" name="submit" value="checkout">
  </div>
  </form>



  <?php
  if (isset($_POST['submit'])) 
  {
    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
    $id_ongkir = $_POST["id_ongkir"];
    $tanggal_pembelian = date("Y-m-d");
    $alamat_pengiriman = $_POST['alamat_pengiriman'];

    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
    $arrayongkir = $ambil->fetch_assoc();
    $nama_kota = $arrayongkir['nama_kota'];
    $tarif = $arrayongkir['tarif'];

    $total_pembelian = $totalbelanja + $tarif;

    $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

    $id_pembelian_barusan = $koneksi->insert_id;

    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
    {
      //mendapatkkan data produk berdasarkan id_produk
      $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk");
      $perproduk = $ambil->fetch_assoc();

      $nama = $perproduk['nama_produk'];
      $harga = $perproduk['harga_produk'];
      $berat =$perproduk['berat_produk'];

      $subberat = $perproduk['berat_produk']*$jumlah;
      $subharga = $perproduk['harga_produk']*$jumlah;
      $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
        VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

      $koneksi ->query("UPDATE produk SET stok_produk = stok_produk -$jumlah WHERE id_produk = '$id_produk'");
    }

    unset($_SESSION["keranjang"]);

    echo "<script>alert('pembelian sukses');</script>";
    echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
  }
  ?>
</div>

  </div>
</section>


</body>
</html>