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
			<li style="border-bottom: solid;"><a href="info_petugas.php">Cek Petugas</a></li>
		<?php
			}
		?>
			<li><a href="info_spp.php">Cek SPP</a></li>
			<li><a href="petunjuk_petugas.php">Petunjuk</a></li>
			<li style="background-color: #01E500FF; border-bottom: solid; border-color: #00BB04FF;"><a href="../action/logout_proses.php"><i class="fas fa-sign-out-alt"></i> Logout | <?php echo $_SESSION['nama_petugas'];?></a></li>
		</ul>
	</nav>
	<div class="container5">
		<h2>DAFTAR PETUGAS</h2>
		<h5>Ket : <i class="fas fa-square" style="color: #FF00E656;"></i> = admin, <i class="fas fa-mouse-pointer"></i> arahkan kursor untuk info lain.</h5>
		<h5>*Petugas yang sudah mengkonfirmasi siswa tidak bisa dihapus.</h5>
		<h4>Mau tambah petugas? <a href="tambah_petugas.php">KLIK SINI!</a></h4>
		<table border="1">
			<tr style="background-color: #75A3FFFF; font-weight: bold;">
				<td>ID PETUGAS</td>
				<td>USERNAME</td>
				<td>PASSWORD</td>
				<td>NAMA PETUGAS</td>
				<td>NO. TELP</td>
				<td>LEVEL</td>
				<td>JML SISWA YG DIKONFIRMASI </td>
				<td>OPSI</td>
			</tr>
			<?php
				if (isset($_GET['info'])) {
					$id_petugas=$_GET['info'];
					$select1=mysqli_query($connect, "SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
				}
				else{
					$select1=mysqli_query($connect, "SELECT * FROM petugas");
				}
				while ($data1=mysqli_fetch_array($select1)) {
					$select2=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_petugas='$data1[id_petugas]'");
					$data2=mysqli_fetch_array($select2);
					$jml_konf=mysqli_num_rows($select2);
			?>
			<tr
			<?php
				if ($data1['level']=='admin') {
			?>
				style="background-color: #FF00E656;"
			<?php
				}
			?>
			>
				<td><?=$data1['id_petugas'];?></td>
				<td><?=$data1['username'];?></td>
				<td><?=$data1['password'];?></td>
				<td><?=$data1['nama_petugas'];?></td>
				<td><?=$data1['no_telp_petugas'];?></td>
				<td><?=$data1['level'];?></td>
				<td><?=$jml_konf;?></td>
				<td><a class="konfirmasi" href="edit_petugas.php?info=<?=$data1['id_petugas'];?>">Edit</a>
			<?php
				if ($jml_konf==0) {
			?>
					 | <a class="batal" href="../action/hapus_petugas_proses.php?info=<?=$data1['id_petugas'];?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')";>Hapus</a>
			<?php
				}
			?>
				</td>
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