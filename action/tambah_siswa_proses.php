<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';

	$nisn=$_POST['nisn'];
	$nis=$_POST['nis'];
	$nama=$_POST['nama'];
	$no_telp=$_POST['no_telp'];
	$alamat=$_POST['alamat'];
	$id_kelas=$_POST['id_kelas'];
	$id_spp=$_POST['id_spp'];

	$tambah=mysqli_query($connect, "INSERT INTO siswa VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$id_spp')");
	if ($tambah) {
?>
		<script type="text/javascript">
			alert("Berhasil tambahkan <?=$nama;?> sebagai siswa baru");
			document.location="../petugas/info_siswa.php";
		</script>
<?php
	}
	else{
?>
		<script type="text/javascript">
			alert("Gagal tambahkan <?=$nama;?> sebagai siswa baru");
			window.history.back();
		</script>
<?php
	}
?>