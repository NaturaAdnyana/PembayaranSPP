<?php
session_start();
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
}
	include '../action/koneksi.php';
	$nisn=$_SESSION['nisn'];
	$data=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$nisn'");
	$cek_status=mysqli_fetch_array($data);
	$cek=mysqli_num_rows($data);
	if ($cek>0) {
		if ($cek_status['no_transaksi']=='') {
				$mtd_pembyr=$cek_status['metode_pembayaran'];
?>
			<script type="text/javascript">
				alert("Anda sebelumnya telah mengirim form. Silahkan bertransaksi dihalaman ini.");
				document.location='transfer_uang.php?metode=<?php echo $mtd_pembyr;?>';
			</script>
<?php
		}
	}
	$id_spp=$_SESSION['id_spp'];
	$data_spp=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$id_spp'");
	$cek_spp=mysqli_fetch_array($data_spp);
	$nominal=$cek_spp['nominal'];
	$harga_spp=number_format($nominal,2,',','.');
	$nominal_cicil=$cek_spp['nominal']/2;
	$harga_spp_cicil=number_format($nominal_cicil,2,',','.');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP | <?php echo $_SESSION['nama'];?></title>
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
			<li style="border-bottom: solid;"><a href="#">Bayar SPP</a></li>
			<li><a href="petunjuk.php">Petunjuk</a></li>
			<li><a href="about.php">Tentang Kami</a></li>
			<li style="background-color: #006EFFBF; border-bottom: solid; border-color: #006EFFBF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama'];?></a></li>
		</ul>
	</nav>
	<div class="container1" align="center">
		<div class="form_spp">
			<h2>Pembayaran SPP</h2>
			<hr style="width: 250px;">
			<h3>Langkah 1</h3>
			<label>Silahkan isi form dibawah ini</label>
			<form method="post"
				<?php
					if ($cek_status['status_bayar']=='Lunas') {
						if ($cek_status['id_petugas']=='') {
				?>
				action="siswa.php"
				<?php
						}
						else{
				?>
				action="siswa.php"
				<?php
						}
					}
					elseif ($cek_status['status_bayar']=='Belum Lunas') {
						if ($cek_status['id_petugas']=='') {
				?>
				action="siswa.php"
				<?php
						}
						else{
				?>
				action="../action/bayarspp_proses.php?status=nyicil"
				<?php
						}
					}
					else{
				?>
				action="../action/bayarspp_proses.php"
				<?php
					}
				?>
				>
				<label>Email :</label><br><input type="text" name="email" placeholder="Email anda" required="" autocomplete="off"><br>
				<label>No. Telepon / WA :</label><br><input type="number" name="telp" placeholder="No. telp anda" value="<?php echo "$_SESSION[no_telp]";?>" required="" autocomplete="off"><br>
				<label>Jumlah Bayar :</label><br>
				<select name="value">
					<?php
						if ($cek_status['status_bayar']=='Belum Lunas') {
					?>
					<option value="<?php echo $nominal_cicil;?>">Cicil per 3bln ( IDR. <?php echo $harga_spp_cicil;?> )</option>
					<?php
						}
						else{
					?>
					<option value="<?php echo $nominal;?>">per THN ( Rp. <?php echo $harga_spp;?> )</option>
					<option value="<?php echo $nominal_cicil;?>">Cicil per SMT ( Rp. <?php echo $harga_spp_cicil;?> )</option>
					<?php
						}
					?>
				</select><br>
				<ul title="Pilih salah satu">
					<label>Metode Pembayaran :</label><br>
					<li title="Gopay"><input type="radio" name="mtd_byr" value="Gopay"><br><img src="../img/gopay.png"></li>
					<li title="OVO"><input type="radio" name="mtd_byr" value="OVO" required=""><br><img style="height: 27px;" src="../img/ovo.png"></li>
					<li title="Dana"><input type="radio" name="mtd_byr" value="Dana"><br><img src="../img/dana.png"></li>
				</ul>
				<input type="submit" value="SETOR FORM"
				<?php
					if ($cek_status['status_bayar']=='Lunas') {
						if ($cek_status['id_petugas']=='') {
				?>
					onclick="alert('Anda sebelumnya telah melunaskan SPP. Mohon tunggu Konfirmasi dari kami.')";
				<?php
						}
						else{
				?>
					onclick="alert('Anda telah melunaskan SPP. Terima kasih telah Bertransaksi dengan kami.')";
				<?php
						}
					}
					elseif ($cek_status['status_bayar']=='Belum Lunas') {
						if ($cek_status['id_petugas']=='') {
				?>
					onclick="alert('Mohon tunggu Konfirmasi pembayaran sebelumnya dari kami sebelum anda melunaskannya.')";
				<?php
						}
						else{
				?>
					onclick="return confirm('Apa anda yakin dengan data ini?')";
				<?php
						}
					}
					else{
				?>
				onclick="return confirm('Apa anda yakin dengan data ini?')";
				<?php
					}
				?>
				>
				<h5>
				<?php
					if ($cek_status['status_bayar']=='Lunas') {
						if ($cek_status['id_petugas']=='') {
							echo "Anda baru saja bayar SPP, mohon tunggu konfirmasi dari kami.";
						}
						else{
							echo "Anda telah bayar SPP tahun ini & tidak perlu membayar lagi.";
						}
					}
					elseif ($cek_status['status_bayar']=='Belum Lunas') {
						if ($cek_status['id_petugas']=='') {
							echo "Mohon jangan melunaskan dahulu sebelum kami menkonfirmasikan form sebelumnya.";
						}
						else{
						echo "Anda telah bayar cicil sebelumnya, silahkan isi form diatas untuk melunaskannya.";
						}
					}
				?>
				</h5>
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