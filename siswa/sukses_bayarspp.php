<?php
session_start();
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sukses Bayar SPP | <?php echo $_SESSION['nama'];?></title>
	<link rel="stylesheet" type="text/css" href="../this.css">
	<link rel="stylesheet" type="text/css" href="this_siswa.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/brands.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/solid.css">
</head>
<body>
	<nav>
		<a href="index.php" title="Program Pembayaran SPP Oneska"><img src="../img/logo_program.png"></a>
		<ul>
			<li><a href="siswa.php">Home</a></li>
			<li><a href="bayarspp.php">Bayar SPP</a></li>
			<li><a href="petunjuk.php">Petunjuk</a></li>
			<li><a href="about.php">Tentang Kami</a></li>
			<li style="background-color: #006EFFBF; border-bottom: solid; border-color: #006EFFBF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama'];?></a></li>
		</ul>
	</nav>
	<div class="container2" align="center">
		<img src="../img/logo_program.png" style="margin-top: 100px;">
		<h2>Pembayaran SPP</h2>
		<hr style="width: 250px;">
		<h3>Finish</h3>
		<div class="pesan_sukses">
			<p>Selamat, anda telah bayar SPP, tunggu konfirmasi dari kami lewat Email/Telp/WA. Atau anda juga bisa mengecek di halaman Home kami.</p>
			<a href="siswa.php">Pergi ke halaman Home</a>
		</div>
	</div>

<?php
	include '../footer.php';
?>
</body>
</html>