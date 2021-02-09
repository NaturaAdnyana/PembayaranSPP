<?php
session_start();
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
	}
	include '../action/koneksi.php';
	$nisn=$_SESSION['nisn'];
	$s_kls=mysqli_query($connect, "SELECT * FROM kelas WHERE id_kelas='$_SESSION[id_kelas]'");
	$d_kls=mysqli_fetch_array($s_kls);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome | <?php echo $_SESSION['nama'];?></title>
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
			<li style="border-bottom: solid;"><a href="#">Home</a></li>
			<li><a href="bayarspp.php">Bayar SPP</a></li>
			<li><a href="petunjuk.php">Petunjuk</a></li>
			<li><a href="about.php">Tentang Kami</a></li>
			<li style="background-color: #006EFFBF; border-bottom: solid; border-color: #006EFFBF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama'];?></a></li>
		</ul>
	</nav>
	<div class="landing_siswa">
		<h1>Anda telah berhasil login</h1>
		<img src="../img/check.svg">
		<hr>
		<h2>Status Bayar SPP :</h2>
		<div class="status_bayar" align="center">
			<h3>-
				<?php
					$data=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$nisn'");
					$cek=mysqli_num_rows($data);
					$cek_status=mysqli_fetch_array($data);
					$mtd_pembyr=$cek_status['metode_pembayaran'];
					if ($cek>0) {
						$status_bayar=$cek_status['status_bayar'];
						echo $status_bayar;
					}
					else{
						echo "Belum Bayar";
					}
				?>
			-</h3>
			<hr>
			<h3>
				<?php
					if ($cek>0) {
						if ($cek_status['id_petugas']=='') {
							if ($cek_status['no_transaksi']=='') {
								echo "Anda belum bertranksaksi";
							}
							else{
								echo "Belum Terkonfirmasi";
							}
						}
						else{
						echo "Sudah Terkonfirmasi";
						}
					}
					else{
						echo "Anda belum<br>bayar SPP";
					}
				?>
			</h3>
			<hr style="margin-bottom: 10px;">
			<h3>
				<?php
					if ($cek_status['status_bayar']=='Lunas') {
						if ($cek_status['id_petugas']=='') {
							if ($cek_status['no_transaksi']=='') {
				?>
								<a href="transfer_uang.php?metode=<?php echo $mtd_pembyr;?>">Transaksi Sekarang</a>
				<?php
							}
							else{
								echo "Mohon tunggu sampai<br>dikonfirmasi <i class='fas fa-user-clock'></i>";
							}
						}
						else{
							echo "Anda telah<br>berhasil bayar SPP";
						}
					}
					elseif ($cek_status['status_bayar']=='Belum Lunas') {
						if ($cek_status['id_petugas']=='') {
							if ($cek_status['no_transaksi']=='') {
				?>
								<a href="transfer_uang.php?metode=<?php echo $mtd_pembyr;?>">Transaksi Sekarang</a>
				<?php
						}
							else{
								echo "Mohon tunggu sampai<br>dikonfirmasi <i class='fas fa-user-clock'></i>";
							}
						}
						else{
				?>
							<a href="bayarspp.php">BAYAR CICIL SEKARANG</a>
				<?php
						}
					}
					else{
				?>
						<a href="bayarspp.php">BAYAR SEKARANG</a>
				<?php
					}
				?>
			</h3>
		</div>
		<div class="status_bayar2">
			<table>
				<tr>
					<td width="70">NAMA</td>
					<td width="10">:</td>
					<td><?=$_SESSION['nama'];?></td>
				</tr>
				<tr>
					<td>NISN</td>
					<td>:</td>
					<td><?=$_SESSION['nisn'];?></td>
				</tr>
				<tr>
					<td>NIS</td>
					<td>:</td>
					<td><?=$_SESSION['nis'];?></td>
				</tr>
				<tr>
					<td>KELAS</td>
					<td>:</td>
					<td><?=$d_kls['nama_kelas'];?></td>
				</tr>
				<tr>
					<td>ALAMAT</td>
					<td>:</td>
					<td><?=$_SESSION['alamat'];?></td>
				</tr>
				<tr>
					<td colspan="3"><i>Ada kesalahan biodata anda? Hub. kami!</i></td>
				</tr>
			</table>
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