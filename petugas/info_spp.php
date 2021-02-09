<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';
	$thn=date('y');
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
			<li style="border-bottom: solid;"><a href="info_spp.php">Cek SPP</a></li>
			<li><a href="petunjuk_petugas.php">Petunjuk</a></li>
			<li style="background-color: #01E500FF; border-bottom: solid; border-color: #00BB04FF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama_petugas'];?></a></li>
		</ul>
	</nav>
	<div class="container5">
		<h2>DAFTAR SPP</h2>
		<h5>Ket : <i class="fas fa-mouse-pointer"></i> arahkan kursor untuk info lain. </h5>
			<?php
				if ($_SESSION['level']=='admin') {
			?>
				<h4>Mau tambah SPP baru?</h4>
				<form action="../action/tambah_spp_proses.php" method="post">
					<input style="width: 60px;" type="number" name="tahun" placeholder="tahun" required="" autocomplete="off">
					<input type="number" name="nominal" placeholder="nominal" required="" autocomplete="off">
					<input type="submit" value="KIRIM">
				</form>
			<?php
				}
			?>
		<table border="1">
			<tr style="background-color: #75A3FFFF; font-weight: bold;">
				<td>ID_SPP</td>
				<td>TAHUN</td>
				<td>NOMINAL</td>
				<td>BANYAK SISWA</td>
				<td>JML. SISWA YG SUDAH BAYAR</td>
				<td>JML. SISWA YG BELUM BAYAR</td>
			<?php
				if ($_SESSION['level']=='admin') {
			?>
				<td>Opsi</td>
			<?php
				}
			?>
			</tr>
			<?php
				if (isset($_GET['info'])) {
					$id_spp=$_GET['info'];
					$select1=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$id_spp'");
				}
				else{
					$select1=mysqli_query($connect, "SELECT * FROM spp");
				}
				while ($data1=mysqli_fetch_array($select1)) {
					$nominal1=$data1['nominal'];
					$spp=number_format($nominal1,2,',','.');
					$select2=mysqli_query($connect, "SELECT * FROM siswa WHERE id_spp='$data1[id_spp]'");
					$hasil1=mysqli_num_rows($select2);
					$select3=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_spp='$data1[id_spp]'");
					$hasil2=mysqli_num_rows($select3);
					$hasil3=$hasil1-$hasil2;
			?>
			<tr>
				<td><?=$data1['id_spp'];?></td>
				<td><?=$data1['tahun'];?></td>
				<td><?=$spp;?></td>
				<td><?=$hasil1;?></td>
				<td><?=$hasil2;?></td>
				<td><?=$hasil3;?></td>
			<?php
				if ($_SESSION['level']=='admin') {
			?>
				<td><a class="konfirmasi" href="edit_spp.php?info=<?=$data1['id_spp'];?>">Edit</a> | <a class="batal" href="../action/hapus_spp_proses.php?info=<?=$data1['id_spp'];?>">Hapus</a></td>
			<?php
				}
			?>
			</tr>
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