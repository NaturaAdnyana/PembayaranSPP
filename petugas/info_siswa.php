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
		<h5>Ket : <i class="fas fa-mouse-pointer"></i> arahkan kursor untuk info lain. </h5>
		<h4>Mau tambah siswa? <a href="tambah_siswa.php">KLIK SINI!</a></h4>
		<table border="1">
			<tr style="background-color: #75A3FFFF; font-weight: bold;">
				<td>NISN</td>
				<td>NIS</td>
				<td>NAMA</td>
				<td>KELAS</td>
				<td>ALAMAT</td>
				<td>NO TELP</td>
				<td>ID SPP</td>
				<td>STATUS SPP</td>
				<td>THN. AJARAN</td>
				<td>OPSI</td>
			</tr>
			<?php
				if (isset($_GET['info'])) {
					$nisn=$_GET['info'];
					$select1=mysqli_query($connect, "SELECT * FROM siswa WHERE nisn='$nisn'");
				}
				else{
					$select1=mysqli_query($connect, "SELECT * FROM siswa");
				}
				while ($data1=mysqli_fetch_array($select1)) {
					$select2=mysqli_query($connect, "SELECT * FROM kelas WHERE id_kelas='$data1[id_kelas]'");
					$data2=mysqli_fetch_array($select2);

					$select3=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$data1[id_spp]'");
					$data3=mysqli_fetch_array($select3);
					$nominal1=$data3['nominal'];
					$spp=number_format($nominal1,2,',','.');

					$select4=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$data1[nisn]'");
					$data4=mysqli_fetch_array($select4);
					$hasil=mysqli_num_rows($select4);
					$status=$data4['status_bayar'];
			?>
			<tr>
				<td><?=$data1['nisn'];?></td>
				<td><?=$data1['nis'];?></td>
				<td><?=$data1['nama'];?></td>
				<td title="ID KLS : <?=$data1['id_kelas'];?>"><?=$data2['nama_kelas'];?> (<?=$data2['kompetensi_keahlian'];?>)</td>
				<td><?=$data1['alamat'];?></td>
				<td><?=$data1['no_telp'];?></td>
				<td title="Nominal : <?=$spp;?>"><a class="cek_info" href="info_spp.php?info=<?=$data1['id_spp'];?>"><?=$data1['id_spp'];?></a></td>
				<td>
			<?php
					if ($hasil>0) {
			?>
						<a class="cek_info" href="petugas.php?kategori=semua&info=<?=$data1['nisn'];?>"><?=$status;?></a>
			<?php
					}
					else{
						echo " - ";
					}
			?>
				</td>
				<td><?=$data3['tahun'];?></td>
				<td><a class="konfirmasi" href="edit_siswa.php?info=<?=$data1['nisn'];?>">Edit</a> | <a class="batal" href="../action/hapus_siswa_proses.php?info=<?=$data1['nisn'];?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')";>Hapus</a></td>
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