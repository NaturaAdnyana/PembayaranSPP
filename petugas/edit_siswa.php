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
	<div class="container5">
		<h2>DAFTAR SISWA</h2>
		<h5>Silahkan ubah data dibawah ini.</h5>
		<table border="1">
			<tr style="background-color: #75A3FFFF; font-weight: bold;">
				<td>NISN</td>
				<td>NIS</td>
				<td>NAMA</td>
				<td>ID KELAS</td>
				<td>ALAMAT</td>
				<td>NO TELP</td>
				<td>ID SPP</td>
			</tr>
			<?php
				if ($_GET['info']) {
					$nisn=$_GET['info'];
					$select1=mysqli_query($connect, "SELECT * FROM siswa WHERE nisn='$nisn'");
					$data1=mysqli_fetch_array($select1);
					$select2=mysqli_query($connect, "SELECT * FROM kelas");
					$select3=mysqli_query($connect, "SELECT * FROM spp");
			?>
			<form method="post" action="../action/edit_siswa_proses.php?info=<?=$nisn;?>">
			<tr>
				<td><input type="text" name="nisn" required="" placeholder="nisn" value="<?=$data1['nisn'];?>"></td>
				<td><input type="text" name="nis" required="" placeholder="nis" value="<?=$data1['nis'];?>"></td>
				<td><input type="text" name="nama" required="" placeholder="nama" value="<?=$data1['nama'];?>"></td>
				<td>
					<select name="id_kelas" required="">
			<?php
					while ($data2=mysqli_fetch_array($select2)) {
			?>
						<option value="<?=$data2['id_kelas'];?>"
			<?php
							if ($data2['id_kelas']==$data1['id_kelas']) {
								echo "selected";
							}
			?>
							>
							<?=$data2['id_kelas'];?>. kls.<?=$data2['nama_kelas'];?> (<?=$data2['kompetensi_keahlian'];?>)
						</option>
			<?php
				}
			?>
					</select>
				</td>
				<td><textarea name="alamat" required="" placeholder="alamat"><?=$data1['alamat'];?></textarea></td>
				<td><input type="number" name="no_telp" required="" placeholder="no telp" value="<?=$data1['no_telp'];?>"></td>
				<td>
					<select name="id_spp" required="">
			<?php
					while ($data3=mysqli_fetch_array($select3)) {
						$nominal1=$data3['nominal'];	
						$spp=number_format($nominal1,2,',','.');
			?>
						<option value="<?=$data3['id_spp'];?>"
			<?php
							if ($data3['id_spp']==$data1['id_spp']) {
								echo "selected";
							}
			?>
							>
							<?=$data3['id_spp'];?> th. <?=$data3['tahun'];?> (<?=$spp;?>)
						</option>
			<?php
				}
			?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="7" align="right"><input class="edit_siswa" type="submit" value="EDIT SISWA"> | <a class="batal" href="info_siswa.php">BATAL</a></td>
			</tr>
			</form>
			<?php
				}
			?>
		</table>
	</div>
<?php
	include '../footer.php';
?>
</body>
</html>