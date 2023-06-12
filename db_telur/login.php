<?php
session_start();
//koneksi de database
$koneksi = new mysqli("localhost","root","","db_telur");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login Form - Pure Coding</title>
</head>
<body background="hy.jpg">
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email_pelanggan">
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password_pelanggan">
			</div>
			<div class="input-group">
				<button name="login" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
		<?php
		if (isset($_POST["login"])) 
{
    $email = $_POST["email_pelanggan"];
    $password = $_POST["password_pelanggan"];
    // lakukan kuery ngecek akun di tabel pelanggan di db
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan= md5('$password')");

    // ngitung akun yang terambil
    $akunyangcocok = $ambil->num_rows;

    // jika 1 akun yang cocok, maka login
    if ($akunyangcocok==1)
    {
        //anda sukses login
        //mendapatkan akun dlm bentuk array
        $akun = $ambil->fetch_assoc();
        //simpan di session pelanggan
        $_SESSION['pelanggan'] = $akun;
        echo "<script>alert('anda sukses login');</script>";
        //jk sudah belanja
        if (isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang']))
        {
        	echo "<script>location='checkout.php';</script";
        }
        else
        {
        	echo "<script>location='riwayat.php';</script>";
        }
    }
    else
    {
        echo "<script>alert('anda gagal login, priksa akun anda');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>
    </div>
</body>
</html>
	</div>
</body>
</html>