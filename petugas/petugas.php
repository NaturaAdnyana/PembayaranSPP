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
			<li style="border-bottom: solid;"><a href="petugas.php?kategori=bayarspp">Home</a></li>
			<li><a href="info_siswa.php">Cek Siswa</a></li>
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
		<?php
			if ($_GET['kategori']=='semua') {
		?>
			<h3>Kategori : <a href="petugas.php?kategori=semua" style="border-bottom: solid 2px;">Semua</a> | <a href="petugas.php?kategori=bayarspp">Bayar SPP</a> | <a href="petugas.php?kategori=lunas">Bayar SPP (Lunas)</a> | <a href="petugas.php?kategori=cicil">Bayar SPP (Cicil)</a> | <a href="petugas.php?kategori=tuntas">Tuntas</a></h3>
			<h2>Daftar siswa yang mengakses pembayaran SPP :</h2>
			<h5>Ket : <i class="fas fa-square" style="color: #10FF006D;"></i> = Tuntas, <i class="fas fa-square" style="color: #FF0097A6;"></i> = Belum transaksi, <i class="fas fa-square" style="color: #FFD700FF;"></i> = Belum terkonfirmasi, <i class="fas fa-mouse-pointer"></i> arahkan kursor untuk info lain. </h5>
			<h5>* sebelum konfirmasi wajib mengecek no. transaksi terlebih dahulu diaplikasi yang sesuai dengan metode pembayarannya.</h5>
			<table border="1">
				<tr style="background-color: #004CFFA6; font-weight: bold;">
					<td>ID BYR.</td>
					<td>NISN</td>
					<td>TGL. BAYAR</td>
					<td>ID SPP</td>
					<td>JUMLAH</td>
					<td>STATUS</td>
					<td>EMAIL</td>
					<td>NO. TELP</td>
					<td>MTD. BYR.</td>
					<td>NO. TRANSAKSI</td>
					<td>ID Petugas</td>
					<td>Opsi</td>
				</tr>
			<?php
				if (isset($_GET['info'])) {
					$nisn=$_GET['info'];
					$select=mysqli_query($connect, "SELECT * FROM pembayaran WHERE nisn='$nisn'");
				}
				else{
					$select=mysqli_query($connect, "SELECT * FROM pembayaran");
				}
				while ($data=mysqli_fetch_array($select)) {
					$nisn=$data['nisn'];
			?>
				<tr
					<?php
						if ($data['no_transaksi']=='') {
				?>
							style="background-color: #FF0097A6;" title="Mohon tunggu sampai siswa ini bertransaksi"
				<?php
						}
						elseif ($data['id_petugas']=='') {
				?>
							style="background-color: #FFCB00B6;" title="Konfirmasi dikategori Bayar SPP"
				<?php
						}
						else{
				?>
							style="background-color: #10FF006D;" title="Siswa ini sudah tuntas membayar SPP"
				<?php
						}
					?>
				>
					<td><?=$data['id_pembayaran'];?></td>
					<td><a class="cek_info" href="info_siswa.php?info=<?=$nisn?>"><?=$nisn?></a></td>
					<td><?=$data['tgl_bayar'];?></td>
					<td><a class="cek_info" href="info_spp.php?info=<?=$data['id_spp'];?>"><?=$data['id_spp'];?></a></td>
					<td><?=$data['jumlah_bayar'];?></td>
					<td><?=$data['status_bayar'];?></td>
					<td><?=$data['email_pembayar'];?></td>
					<td><?=$data['telp_pembayar'];?></td>
					<td><?=$data['metode_pembayaran'];?></td>
					<td>
						<?php
							if ($data['no_transaksi']=='') {
								echo " - ";
							}
							else{
								echo $data['no_transaksi'];
							}


						?>
					</td>
					<td
						<?php
							if ($data['id_petugas']!='') {
								$select2=mysqli_query($connect, "SELECT * FROM petugas WHERE id_petugas=$data[id_petugas]");
								$data2=mysqli_fetch_array($select2);
								$nama_petugas=$data2['nama_petugas'];
								echo "title='$nama_petugas'";
							}
						?>
					>
						<?php
							if ($data['id_petugas']=='') {
								if ($data['no_transaksi']!='') {
						?>
								<a class="konfirmasi" href="../action/konfirmasi_proses.php?info=<?=$nisn?>" title="Konfirmasi atas nama saya">Konfimasikan</a>
						<?php
								}
							}
							else{
								if ($_SESSION['level']=='admin') {
						?>
									<a class="cek_info" href="info_petugas.php?info=<?=$data['id_petugas'];?>"><?=$data['id_petugas'];?></a>
						<?php
								}
								else{
									echo $data['id_petugas'];
								}
							}

						?>
					</td>
					<td><a class="batal" title="Hapus dari daftar" href="../action/hapus_daftar_proses.php?info=<?=$nisn?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')";>Hapus</a></td>
				</tr>
			<?php
				}
			?>
			</table>
		<?php
			}
			elseif ($_GET['kategori']=='bayarspp') {
		?>
			<h3>Kategori : <a href="petugas.php?kategori=semua">Semua</a> | <a href="petugas.php?kategori=bayarspp" style="border-bottom: solid 2px;">Bayar SPP</a> | <a href="petugas.php?kategori=lunas">Bayar SPP (Lunas)</a> | <a href="petugas.php?kategori=cicil">Bayar SPP (Cicil)</a> | <a href="petugas.php?kategori=tuntas">Tuntas</a></h3>
			<h2>Daftar siswa yang baru saja membayar SPP :</h2>
			<h5>Ket : <i class="fas fa-square" style="color: #FF9D00BD;"></i> = Nyicil, <i class="fas fa-square" style="color: #90E519FF;"></i> = Lunas.</h5>
			<h5>* sebelum konfirmasi wajib mengecek no. transaksi terlebih dahulu diaplikasi yang sesuai dengan metode pembayarannya.</h5>
			<table border="1">
				<tr style="background-color: #75A3FFFF; font-weight: bold;">
					<td>ID BYR.</td>
					<td>NISN</td>
					<td>TGL. BAYAR</td>
					<td>ID SPP</td>
					<td>JUMLAH</td>
					<td>STATUS</td>
					<td>EMAIL</td>
					<td>NO. TELP</td>
					<td>MTD. PEMBAYARAN</td>
					<td>NO. TRANSAKSI</td>
					<td>Opsi</td>
				</tr>
			<?php
				$select=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_petugas IS NULL AND no_transaksi !=''");
				while ($data=mysqli_fetch_array($select)) {
					$nisn=$data['nisn'];
			?>
				<tr
					<?php
						if ($data['status_bayar']=='Lunas') {
					?>
						style="background-color: #49FF0091;"
					<?php
						}
						elseif ($data['status_bayar']=='Belum Lunas') {
					?>
						style="background-color: #FF9D00BD;"
					<?php
						}

					?>
				>
					<td><?=$data['id_pembayaran'];?></td>
					<td><a class="cek_info" href="info_siswa.php?info=<?=$nisn?>"><?=$nisn?></a></td>
					<td><?=$data['tgl_bayar'];?></td>
					<td><a class="cek_info" href="info_spp.php?info=<?=$data['id_spp'];?>"><?=$data['id_spp'];?></a></td>
					<td><?=$data['jumlah_bayar'];?></td>
					<td><?=$data['status_bayar'];?></td>
					<td><?=$data['email_pembayar'];?></td>
					<td><?=$data['telp_pembayar'];?></td>
					<td><?=$data['metode_pembayaran']?></td>
					<td><?=$data['no_transaksi'];?></td>
					<td><a class="konfirmasi" href="../action/konfirmasi_proses.php?info=<?=$nisn?>" title="Konfirmasi atas nama saya">Konfimasikan</a>|<a class="batal" title="Batalkan transaksi ini" href="../action/hapus_daftar_proses.php?info=<?=$nisn;?>" onclick="return confirm('Apakah anda ingin membatalkan pembayaran ini?')";>Batalkan</a></td>
				</tr>
			<?php
			}
			?>
			</table>
		<?php
		}
		elseif ($_GET['kategori']=='lunas') {
		?>
		<h3>Kategori : <a href="petugas.php?kategori=semua">Semua</a> | <a href="petugas.php?kategori=bayarspp">Bayar SPP</a> | <a href="petugas.php?kategori=lunas" style="border-bottom: solid 2px;">Bayar SPP (Lunas)</a> | <a href="petugas.php?kategori=cicil">Bayar SPP (Cicil)</a> | <a href="petugas.php?kategori=tuntas">Tuntas</a></h3>
		<h2>Daftar siswa yang mau lunaskan SPP :</h2>
		<h5>* sebelum konfirmasi wajib mengecek no. transaksi terlebih dahulu diaplikasi yang sesuai dengan metode pembayarannya.</h5>
			<table border="1">
				<tr style="background-color: #75A3FFFF; font-weight: bold;">
					<td>ID BYR.</td>
					<td>NISN</td>
					<td>TGL. BAYAR</td>
					<td>ID SPP</td>
					<td>JUMLAH</td>
					<td>STATUS</td>
					<td>EMAIL</td>
					<td>NO. TELP</td>
					<td>MTD. PEMBAYARAN</td>
					<td>NO. TRANSAKSI</td>
					<td>Opsi</td>
				</tr>
			<?php
				$select=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_petugas IS NULL AND no_transaksi !='' AND status_bayar='Lunas'");
				while ($data=mysqli_fetch_array($select)) {
					$nisn=$data['nisn'];
			?>
				<tr>
					<td><?=$data['id_pembayaran'];?></td>
					<td><a class="cek_info" class="cek_nisn" href="info_siswa.php?info=<?=$nisn?>"><?=$nisn?></a></td>
					<td><?=$data['tgl_bayar'];?></td>
					<td><a class="cek_info" href="info_spp.php?info=<?=$data['id_spp'];?>"><?=$data['id_spp'];?></a></td>
					<td><?=$data['jumlah_bayar'];?></td>
					<td><?=$data['status_bayar'];?></td>
					<td><?=$data['email_pembayar'];?></td>
					<td><?=$data['telp_pembayar'];?></td>
					<td><?=$data['metode_pembayaran'];?></td>
					<td><?=$data['no_transaksi'];?></td>
					<td><a class="konfirmasi" href="../action/konfirmasi_proses.php?info=<?=$nisn?>" title="Konfirmasi atas nama saya">Konfimasikan</a> | <a class="batal" title="Batalkan transaksi ini" href="../action/hapus_daftar_proses.php?info=<?=$nisn;?>" onclick="return confirm('Apakah anda ingin membatalkan pembayaran ini?')";>Batalkan</a></td>
				</tr>
			<?php
			}
			?>
			</table>
		<?php
		}
		elseif ($_GET['kategori']=='cicil') {
		?>
		<h3>Kategori : <a href="petugas.php?kategori=semua">Semua</a> | <a href="petugas.php?kategori=bayarspp">Bayar SPP</a> | <a href="petugas.php?kategori=lunas">Bayar SPP (Lunas)</a> | <a href="petugas.php?kategori=cicil" style="border-bottom: solid 2px;">Bayar SPP (Cicil)</a> | <a href="petugas.php?kategori=tuntas">Tuntas</a></h3>
		<h2>Daftar siswa yang mau cicil SPP :</h2>
		<h5>* sebelum konfirmasi wajib mengecek no. transaksi terlebih dahulu diaplikasi yang sesuai dengan metode pembayarannya.</h5>
			<table border="1">
				<tr style="background-color: #75A3FFFF; font-weight: bold;">
					<td>ID BYR.</td>
					<td>NISN</td>
					<td>TGL. BAYAR</td>
					<td>ID SPP</td>
					<td>JUMLAH</td>
					<td>STATUS</td>
					<td>EMAIL</td>
					<td>NO. TELP</td>
					<td>MTD. PEMBAYARAN</td>
					<td>NO. TRANSAKSI</td>
					<td>Opsi</td>
				</tr>
			<?php
				$select=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_petugas IS NULL AND no_transaksi !='' AND status_bayar='Belum Lunas'");
				while ($data=mysqli_fetch_array($select)) {
					$nisn=$data['nisn'];
			?>
				<tr>
					<td><?=$data['id_pembayaran'];?></td>
					<td><a class="cek_info" class="cek_nisn" href="info_siswa.php?info=<?=$nisn?>"><?=$nisn?></a></td>
					<td><?=$data['tgl_bayar'];?></td>
					<td><a class="cek_info" href="info_spp.php?info=<?=$data['id_spp'];?>"><?=$data['id_spp'];?></a></td>
					<td><?=$data['jumlah_bayar'];?></td>
					<td><?=$data['status_bayar'];?></td>
					<td><?=$data['email_pembayar'];?></td>
					<td><?=$data['telp_pembayar'];?></td>
					<td><?=$data['metode_pembayaran'];?></td>
					<td><?=$data['no_transaksi'];?></td>
					<td><a class="konfirmasi" href="../action/konfirmasi_proses.php?info=<?=$nisn?>" title="Konfirmasi atas nama saya">Konfimasikan</a> | <a class="batal" title="Batalkan transaksi ini" href="../action/hapus_daftar_proses.php?info=<?=$nisn;?>" onclick="return confirm('Apakah anda ingin membatalkan pembayaran ini?')";>Batalkan</a></td>
				</tr>
			<?php
			}
			?>
			</table>
		<?php
		}
		elseif ($_GET['kategori']=='tuntas') {
		?>
		<h3>Kategori : <a href="petugas.php?kategori=semua">Semua</a> | <a href="petugas.php?kategori=bayarspp">Bayar SPP</a> | <a href="petugas.php?kategori=lunas">Bayar SPP (Lunas)</a> | <a href="petugas.php?kategori=cicil">Bayar SPP (Cicil)</a> | <a href="petugas.php?kategori=tuntas" style="border-bottom: solid 2px;">Tuntas</a></h3>
		<h2>Daftar siswa yang sudah selesai membayar SPP :</h2>
		<h5>Ket : <i class="fas fa-mouse-pointer"></i> arahkan kursor untuk info lain. </h5>
			<table border="1">
				<tr style="background-color: #75A3FFFF; font-weight: bold;">
					<td>ID BYR.</td>
					<td>NISN</td>
					<td>TGL. BAYAR</td>
					<td>ID SPP</td>
					<td>JUMLAH</td>
					<td>STATUS</td>
					<td>EMAIL</td>
					<td>NO. TELP</td>
					<td>MTD. PEMBAYARAN</td>
					<td>NO. TRANSAKSI</td>
					<td>ID PETUGAS</td>
					<td>Opsi</td>
				</tr>
			<?php
				$select1=mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_petugas IS NOT NULL");
				while ($data=mysqli_fetch_array($select1)) {
					$nisn=$data['nisn'];
			?>
				<tr>
					<td><?=$data['id_pembayaran'];?></td>
					<td><a class="cek_info" href="info_siswa.php?info=<?=$nisn?>"><?=$nisn?></a></td>
					<td><?=$data['tgl_bayar'];?></td>
					<td><a class="cek_info" href="info_spp.php?info=<?=$data['id_spp'];?>"><?=$data['id_spp'];?></a></td>
					<td><?=$data['jumlah_bayar'];?></td>
					<td><?=$data['status_bayar'];?></td>
					<td><?=$data['email_pembayar'];?></td>
					<td><?=$data['telp_pembayar'];?></td>
					<td><?=$data['metode_pembayaran'];?></td>
					<td><?=$data['no_transaksi'];?></td>
					<td
						<?php
							$select2=mysqli_query($connect, "SELECT * FROM petugas WHERE id_petugas=$data[id_petugas]");
							$data2=mysqli_fetch_array($select2);
							$nama_petugas=$data2['nama_petugas'];
							echo "title='$nama_petugas'";
						?>
					>
			<?php
				if ($_SESSION['level']=='admin') {
			?>
					<a class="cek_info" href="info_petugas.php?info=<?=$data['id_petugas'];?>"><?=$data['id_petugas'];?></a>
			<?php
				}
				else{
					echo $data['id_petugas'];
				}
			?>
					</td>
					<td><a class="batal" title="Hapus daftar ini" href="../action/hapus_daftar_proses.php?info=<?=$nisn;?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')";>Hapus</a></td>
				</tr>
			<?php
			}
			?>
			</table>
		<?php
		}
		?>
	</div>
	
<?php
	include '../footer.php';
?>
</body>
</html>