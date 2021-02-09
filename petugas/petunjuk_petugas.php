<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
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
			<li><a href="info_petugas.php">Cek Petugas</a></li>
		<?php
			}
		?>
			<li><a href="info_spp.php">Cek SPP</a></li>
			<li style="border-bottom: solid;"><a href="petunjuk_petugas.php">Petunjuk</a></li>
			<li style="background-color: #01E500FF; border-bottom: solid; border-color: #00BB04FF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama_petugas'];?></a></li>
		</ul>
	</nav>
	<div class="container6">
		<h1>PETUNJUK CARA (PETUGAS)</h1>
		<br>
		<ol style="line-height: 1.4em;">
			<li><b style="font-size: 20px;">TAB HOME</b>
				<ul style="margin-left: 20px;">
					<li>Dihalaman ini, akan muncul tabel-tabel data seputar siswa yang aktif diweb ini.</li>
					<li>Ada beberapa pilihan opsi untuk melakukan act pada siswa tersebut dalam kolom <i>opsi.</i></li>
					<li>Jika ingin mengkonfirmasi siswa, anda bisa memilih opsi <i>konfirmasi</i> yang sudah disediakan dibaris siswa tersebut.</li>
					<li>Jika siswa tersebut ingin membatalkan transaksi, anda bisa menghapus siswa tersebut dari data dengan memilih opsi <i>hapus.</i></li>
					<li>Anda juga bisa memilih kategori untuk mempermudah mengurus siswa.</li>
				</ul>
			</li><br>
			<li><b style="font-size: 20px;">TAB SISWA</b>
				<ul style="margin-left: 20px;">
					<li>Dihalaman ini, akan muncul tabel-tabel data siswa yang sudah terdaftar dalam web ini.</li>
					<li>Jika ada siswa yang belum terdaftar, silahkan tambahkan siswa pada link yang sudah disediakan dihalaman tersebut.</li>
					<li>Anda juga bisa mengedit siswa jika ada data yang salah dan juga bisa menghapus siswa.</li>
				</ul>
			</li><br>
			<li><b style="font-size: 20px;">TAB SPP</b>
				<ul style="margin-left: 20px;">
					<li>Dihalaman ini, akan muncul tabel-tabel data SPP yang tiap kali ada perubahan.</li>
				</ul>
			</li>
		</ol>
	</div>
<?php
	include '../footer.php'
?>
</body>
</html>