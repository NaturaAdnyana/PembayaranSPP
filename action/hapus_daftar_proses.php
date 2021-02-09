<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';

	if ($_GET['info']) {
		$nisn=$_GET['info'];
		$hapus=mysqli_query($connect, "DELETE FROM pembayaran WHERE nisn='$nisn'");
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
		header("location:../petugas/petugas.php?kategori=bayarspp");
	}
?>