<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	elseif ($_SESSION['level']=='petugas') {
		header("location:petugas.php?kategori=bayarspp");
	}
	include '../action/koneksi.php';

	if ($_GET['info']) {
		$id_spp=$_GET['info'];
		$tahun=$_POST['tahun'];
		$nominal=$_POST['nominal'];
		$edit=mysqli_query($connect, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id_spp'");
		if ($edit) {
?>
			<script type="text/javascript">
				alert("Berhasil edit SPP");
				document.location='../petugas/info_spp.php';
			</script>
<?php
		}
		else{
?>
			<script type="text/javascript">
				alert("Gagal mengedit data, cobalah sesaat lagi.");
				window.history.back();
			</script>
<?php
		}
	}
	else{
		header("location:../petugas/info_spp.php");
	}
?>