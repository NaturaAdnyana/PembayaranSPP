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
		$id_petugas=$_GET['info'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$nama_petugas=$_POST['nama_petugas'];
		$no_telp_petugas=$_POST['no_telp_petugas'];
		$level=$_POST['level'];
		$edit=mysqli_query($connect, "UPDATE petugas SET username='$username', password='$password', nama_petugas='$nama_petugas', no_telp_petugas='$no_telp_petugas', level='$level' WHERE id_petugas='$id_petugas'");
		if ($edit) {
?>
			<script type="text/javascript">
				alert("Berhasil edit petugas");
				document.location='../petugas/info_petugas.php';
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
		header("location:../petugas/info_petugas.php");
	}
?>