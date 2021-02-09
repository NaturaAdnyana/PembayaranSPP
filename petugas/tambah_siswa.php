<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';
	$select1=mysqli_query($connect, "SELECT * FROM kelas");
	$select2=mysqli_query($connect, "SELECT * FROM spp");
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
			<li style="border-bottom: solid;"><a href="info_siswa.php">Cek Siswa</a></li>
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
	<div class="container7">
		<h2>TAMBAH SISWA</h2>
		<h4>Silahkan isi formulir dibawah ini.</h4>
		<form action="../action/tambah_siswa_proses.php" method="post">
		<a href="info_siswa.php"><i class="fas fa-arrow-left"></i> KEMBALI</a>
		<img src="../img/check.svg">
		<table>
			<tr>
				<td><label>NISN</label></td>
				<td><label>NIS</label></td>
				<td><label>NAMA LENGKAP</label></td>
			</tr>
			<tr>
				<td><input type="text" name="nisn" placeholder="nisn baru" required="" autocomplete="off"></td>
				<td><input type="text" name="nis" placeholder="nis baru" required="" autocomplete="off"></td>
				<td><input type="text" name="nama" placeholder="nama siswa" required="" autocomplete="off"></td>
			</tr>
			<tr>
				<td><label>NO TELP</label></td>
				<td><label>ALAMAT</label></td>
				<td rowspan="3"><input type="submit" value="TAMBAHKAN"></td>
			</tr>
			<tr>
				<td><input type="number" name="no_telp" placeholder="no. telp" required="" autocomplete="off"></td>
				<td><textarea name="alamat" placeholder="alamat siswa" required=""></textarea></td>
			</tr>
			<tr>
				<td><label>ID KELAS </label>
					<select name="id_kelas" required="">
						<option></option>
					<?php
					while ($data1=mysqli_fetch_array($select1)) {
					?>
						<option value="<?=$data1['id_kelas'];?>"><?=$data1['id_kelas'];?>. kls. <?=$data1['nama_kelas'];?> (<?=$data1['kompetensi_keahlian'];?>)</option>
					<?php
					}
					?>
					</select>
				</td>
				<td><label>ID SPP </label>
					<select name="id_spp" required="">
						<option></option>
					<?php
					while ($data2=mysqli_fetch_array($select2)) {
						$nominal1=$data2['nominal'];	
						$spp=number_format($nominal1,2,',','.');
					?>
						<option value="<?=$data2['id_spp'];?>"><?=$data2['id_spp'];?>. th.<?=$data2['tahun'];?> (<?=$spp;?>)</option>
					<?php
					}
					?>
					</select>
				</td>
			</tr>
		</table>
		</form>
	</div>
<?php
	include '../footer.php';
?>
</body>
</html>