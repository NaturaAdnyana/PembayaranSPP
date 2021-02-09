<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	elseif ($_SESSION['level']=='petugas') {
		header("location:petugas.php?kategori=bayarspp");
	}
	include '../action/koneksi.php';

	$tahun=$_POST['tahun'];
	$nominal=$_POST['nominal'];

	$tambah=mysqli_query($connect, "INSERT INTO spp VALUES ('','$tahun','$nominal')");
	if ($tambah) {
?>
		<script type="text/javascript">
			alert("Berhasil tambahkan SPP baru");
			document.location="../petugas/info_spp.php";
		</script>
<?php
	}
	else{
?>
		<script type="text/javascript">
			alert("Gagal tambahkan SPP baru");
			window.history.back();
		</script>
<?php
	}
?>