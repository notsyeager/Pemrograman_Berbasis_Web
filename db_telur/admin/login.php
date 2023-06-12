<?php
session_start();
// koneksi
$koneksi = new mysqli("localhost","root","","db_telur");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />
    <title>Login Form - Pure Coding</title>
</head>
<body background="eggs.jfif">
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 500;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" >
            </div>
            <div class="input-group">
                <input type="password" placeholder="password" name="password" >
            </div>
            <div class="input-group">
                <button name="login" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
        </form>  
        <?php
         if (isset($_POST['login']))
        {
            $ambil=$koneksi->query("SELECT * FROM admin WHERE username ='$_POST[email]' AND password = md5('$_POST[password]')");
            $yangcocok = $ambil->num_rows;
            if ($yangcocok==1) 
            {
                $_SESSION['admin']=$ambil->fetch_assoc();
                echo "<div class='alert alert-info'>Login Sukses</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            }
            else
            {
                echo '<script>alert("email atau password Anda salah!")</script>';
                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
            }
        }
        ?>
    </div>
</body>
</html>