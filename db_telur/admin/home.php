<center><h1>Selamat Datang Administrator</h1></center>

<h2>  Data Admin Supran Noto</h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Nama Lengkap</th>

		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while($pecah =$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['username']; ?></td>
			<td><?php echo $pecah['nama_lengkap']; ?></td>
		</tr>
		<?php $nomor++;?>
		<?php } ?>
	</tbody>
</table>
<h2> Data Pelanggan </h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama</th>
			<th>email</th>
			<th>telepon</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
		<?php while($pecah =$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['email_pelanggan']; ?></td>
			<td><?php echo $pecah['telepon_pelanggan']; ?></td>
		</tr>
		<?php $nomor++;?>
		<?php } ?>
	</tbody>
</table>