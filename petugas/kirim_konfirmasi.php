<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';
	if ($_GET['info']) {
		$nisn=$_GET['info'];
		$select1=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$nisn'");
		$data1=mysqli_fetch_array($select1);
		$nominal1=$data1['jumlah_bayar'];
		$jumlah_bayar=number_format($nominal1,2,',','.');
		$select2=mysqli_query($connect, "SELECT * FROM siswa WHERE nisn='$nisn'");
		$data2=mysqli_fetch_array($select2);
		$select3=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$data1[id_spp]'");
		$data3=mysqli_fetch_array($select3);
		$nominal2=$data3['nominal'];
		$spp=number_format($nominal2,2,',','.');
		$select4=mysqli_query($connect, "SELECT * FROM kelas WHERE id_kelas='$data2[id_kelas]'");
		$data4=mysqli_fetch_array($select4);
	}
	else{
		header("location:../petugas/petugas.php?kategori=bayarspp");
	}
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
			<li style="border-bottom: solid;"><a href="#">Home</a></li>
			<li><a href="cek_siswa.php">Cek Siswa</a></li>
		<?php
			if ($_SESSION['level']=='admin') {
		?>
			<li><a href="info_petugas.php">Cek Petugas</a></li>
		<?php
			}
		?>
			<li><a href="info_spp.php">Cek SPP</a></li>
			<li><a href="petunjuk_petugas.php">Petunjuk</a></li>
			<li style="background-color: #01E500FF; border-bottom: solid; border-color: #00BB04FF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama_petugas'];?></a></li>
		</ul>
	</nav>
	<div class="container6">
		<h2>RINCIAN PEMBAYARAN</h2>
		<table>
			<tr>
				<td class="list">NISN</td>
				<td style="width: 25%;">: <?=$nisn;?></td>
				<td class="list">TGL. DIBAYAR</td>
				<td style="width: 20%;">: <?=$data1['tgl_bayar'];?></td>
				<td class="list">NO. PEMBAYARAN</td>
				<td>: <?=$data1['id_pembayaran'];?></td>
			</tr>
			<tr>
				<td class="list">NIS</td>
				<td>: <?=$data2['nis'];?></td>
				<td class="list">METODE PEMBAYARAN</td>
				<td>: <?=$data1['metode_pembayaran'];?></td>
				<td class="list">NO. TRANSAKSI</td>
				<td>: <?=$data1['no_transaksi'];?></td>
			</tr>
			<tr>
				<td class="list">NAMA</td>
				<td>: <?=$data2['nama'];?></td>
				<td class="list">HARGA SPP</td>
				<td>: <?=$spp;?></td>
				<td class="list">EMAIL</td>
				<td>: <?=$data1['email_pembayar'];?></td>
			</tr>
			<tr>
				<td class="list">KELAS</td>
				<td>: <?=$data4['nama_kelas'];?> (<?=$data4['kompetensi_keahlian'];?>)</td>
				<td class="list">DIBAYAR</td>
				<td>: <?=$jumlah_bayar;?> (<?=$data1['status_bayar'];?>)</td>
				<td class="list">NO. TELEPON</td>
				<td>: <?=$data1['telp_pembayar'];?></td>
			</tr>
		</table>
		<a class="kirim_pesan" href="mailto:<?=$data1['email_pembayar'];?>?subject=Konfirmasi%20Bayar%20SPP&body=Yth.%20<?=$data2['nama'];?>%0AAnda%20telah%20terkonfirmasi%20untuk%20bayar%20SPP.%20Terima%20kasih%20telah%20bertransaksi%20dengan%20kami.%0AUntuk%20info%20lebih%20lanjut%20kunjungi%20website%20kami%20kembali.">KONFIRMASI LEWAT EMAIL <i class="fas fa-envelope"></i></a>
		<a class="kirim_pesan" href="sms:<?=$data1['telp_pembayar'];?>?body=Yth.%20<?=$data2['nama'];?>%0AAnda%20telah%20terkonfirmasi%20untuk%20bayar%20SPP.%20Terima%20kasih%20telah%20bertransaksi%20dengan%20kami.%0AUntuk%20info%20lebih%20lanjut%20kunjungi%20website%20kami%20kembali.">KONFIRMASIKAN LEWAT NO. TELP <i class="fas fa-sms"></i></a>
		<a class="selesai_konf" href="../petugas/petugas.php?kategori=bayarspp">SELESAI <i class="fas fa-check"></i></a>
	</div>
<?php
	include '../footer.php';
?>
</body>
</html>