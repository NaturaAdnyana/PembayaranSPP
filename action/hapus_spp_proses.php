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
		$hapus=mysqli_query($connect, "DELETE FROM spp WHERE id_spp='$id_spp'");
		if ($hapus) {
?>
			<script type="text/javascript">
				window.history.back();
			</script>
<?php
		}
		else{
?>
			<script type="text/javascript">
				alert("Gagal menghapus data, cobalah sesaat lagi.");
				window.history.back();
			</script>
<?php
		}
	}
	else{
		header("location:../petugas/info_spp.php");
	}
?>