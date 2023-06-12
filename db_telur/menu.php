<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1><a href="index.php">Penjualan Telur</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="keranjang.php">Keranjang</a></li>
          <li><a class="nav-link scrollto" href="checkout.php">Checkout</a></li>
          <?php if (isset($_SESSION["pelanggan"])): ?>
          <li><a class="nav-link scrollto " href="riwayat.php">Riwayat Belanja</a></li>
          <li><a class="nav-link scrollto " href="logout.php">Logout</a></li>
          <?php else: ?>
          <li class="dropdown"><a href="#"><span>Menu</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="daftar.php">Daftar</a></li>
              <li><a href="login.php">Login</a></li>
            </ul>
          </li>
          <?php endif ?>
          <li><a href=""></a></li>
         <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword" placeholder="Search...">
            <button class="btn btn-warning">Cari</button>
          </form>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>