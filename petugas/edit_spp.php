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
		<h2>EDIT SPP</h2>
		<h5>Silahkan ubah data dibawah ini.</h5>
		<table border="1">
			<tr style="background-color: #75A3FFFF; font-weight: bold;">
				<td>ID SPP</td>
				<td>TAHUN</td>
				<td>NOMINAL</td>
			</tr>
			<?php
				if ($_GET['info']) {
					$id_spp=$_GET['info'];
					$select1=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$id_spp'");
					$data1=mysqli_fetch_array($select1);
			?>
			<form method="post" action="../action/edit_spp_proses.php?info=<?=$id_spp;?>">
			<tr>
				<td><?=$data1['id_spp'];?></td>
				<td><input type="number" name="tahun" required="" placeholder="tahun" value="<?=$data1['tahun'];?>"></td>
				<td><input type="number" name="nominal" required="" placeholder="nominal" value="<?=$data1['nominal'];?>"></td>
			<tr>
				<td colspan="7" align="right"><input class="edit_siswa" type="submit" value="EDIT PETUGAS"> | <a class="batal" href="info_spp.php">BATAL</a></td>
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