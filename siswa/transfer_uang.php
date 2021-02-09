<?php
session_start();
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
}
	include '../action/koneksi.php';
	$nisn=$_SESSION['nisn'];
	$data=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$nisn'");
	$cek_status=mysqli_fetch_array($data);
	$nominal=$cek_status['jumlah_bayar'];
	$harga_spp=number_format($nominal,2,',','.');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Transfer Uang | <?php echo $_SESSION['nama'];?></title>
	<link rel="stylesheet" type="text/css" href="../this.css">
	<link rel="stylesheet" type="text/css" href="this_siswa.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/brands.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/solid.css">
</head>
<body>
	<div class="container2" align="center">
		<img src="../img/logo_program.png">
		<h2>Pembayaran SPP</h2>
		<hr style="width: 250px;">
		<h3>Langkah 2</h3>
		<label>Jumlah Tunai pembayaran SPP anda : Rp. <?php echo $harga_spp;?></label><br>
		<label>Silahkan scan QRCODE dibawah ini dengan Aplikasi yang sesuai :</label>
		<div class="qrcode_box">
		<?php
			if (isset($_GET['metode'])) {
				if ($_GET['metode']=="Gopay") {
		?>
			<img class="logo_qr" src="../img/gopay.png"><br>
			<img src="../img/qrcode_gopay_oneska.jpg"><br>
			<label>Jika anda pakai Smartphone, Anda boleh Download QRcode kami.</label><br>
			<a href="../img/qrcode_gopay_oneska.jpg" download>Download</a>
		<?php
				}
				elseif ($_GET['metode']=="OVO") {
		?>
			<img class="logo_qr" src="../img/ovo.png"><br>
			<img src="../img/qrcode_OVO_oneska.jpg"><br>
			<label>Jika anda pakai Smartphone, Anda boleh Download QRcode kami.</label><br>
			<a href="../img/qrcode_OVO_oneska.jpg" download>Download</a>
		<?php
				}
				elseif ($_GET['metode']=="Dana") {
		?>
			<img class="logo_qr" src="../img/dana.png"><br>
			<img src="../img/qrcode_dana_oneska.png"><br>
			<label>Jika anda pakai Smartphone, Anda boleh Download QRcode kami.</label><br>
			<a href="../img/qrcode_dana_oneska.png" download>Download</a>

		<?php
				}
			}
		?>
		<hr>
		<label>Isi No. Transaksi anda sesudah ditransfer</label>
		<form method="post" action="../action/transaksi_proses.php">
			<h3>No. Transaksi :</h3>
			<input type="text" name="no_transaksi" placeholder="No. transaksi anda" required="" autocomplete="off"><br>
			<input type="submit" value="Kirim"><br>
<!-- 			<a href="../action/batal_transaksi.php?info=<?php echo $nisn;?>" class="batal_transaksi">Batal</a> -->
		</form>
		</div>
	</div>
	<div class="contact" align="center" title="Contact Us">
		<img src="../img/costumer.svg" align="center">
		<a href="https://api.whatsapp.com/send?phone=6281111111111&text=Ask%20SPP%20ONESKA%0A-" title="Contact Us"><i class="fab fa-whatsapp"></i></a>
		<a href="tel:+62361943414"><i class="fas fa-phone-alt"></i></a>
	</div>
<?php
	include '../footer.php';
?>
</body>
</html>