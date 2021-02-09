<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	elseif ($_SESSION['level']=='petugas') {
		header("location:petugas.php?kategori=bayarspp");
	}
	include '../action/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome | <?php echo $_SESSION['nama_petugas'];?></title>
	<link rel="stylesheet" type="text/css" href="../this.css">
	<link rel="stylesheet" type="text/css" href="this_petugas.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/brands.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/solid.css">
</head>
<body>
	<nav>
		<a href="index.php" title="Program Pembayaran SPP Oneska"><img src="../img/logo_program.png"></a>
		<ul>
			<li><a href="petugas.php?kategori=bayarspp">Home</a></li>
			<li><a href="info_siswa.php">Cek Siswa</a></li>
		<?php
			if ($_SESSION['level']=='admin') {
		?>
			<li style="border-bottom: solid;"><a href="info_petugas.php">Cek Petugas</a></li>
		<?php
			}
		?>
			<li><a href="info_spp.php">Cek SPP</a></li>
			<li><a href="petunjuk_petugas.php">Petunjuk</a></li>
			<li style="background-color: #01E500FF; border-bottom: solid; border-color: #00BB04FF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama_petugas'];?></a></li>
		</ul>
	</nav>
	<div class="container7">
		<h2>TAMBAH PETUGAS</h2>
		<h4>Silahkan isi formulir dibawah ini.</h4>
		<form action="../action/tambah_petugas_proses.php" method="post">
		<a href="info_petugas.php"><i class="fas fa-arrow-left"></i> KEMBALI</a>
		<img src="../img/check.svg">
		<table>
			<tr>
				<td><label>USERNAME</label></td>
				<td><label>PASSWORD</label></td>
			</tr>
			<tr>
				<td><input type="text" name="username" placeholder="username" required="" autocomplete="off"></td>
				<td><input type="text" name="password" placeholder="password" required="" autocomplete="off"></td>
			</tr>
			<tr>
				<td><label>NAMA LENGKAP</label></td>
				<td><label>NO TELP</label></td>
			</tr>
			<tr>
				<td><input style="margin-bottom: 29px;" type="text" name="nama" placeholder="nama petugas" required="" autocomplete="off"></td>
				<td><input type="number" name="no_telp_petugas" placeholder="no telp" required="" autocomplete="off"></td>
			</tr>
			<tr>
				<td><label>LEVEL : </label>
					<select name="level" required="">
						<option></option>
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</td>
				<td><input type="submit" value="TAMBAHKAN"></td>
			</tr>
		</table>
		<img class="cs_img" src="../img/customer-service.svg">
		</form>
	</div>
<?php
	include '../footer.php';
?>
</body>
</html>