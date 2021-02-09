<?php
	session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';

	if ($_GET['info']) {
		$nisn=$_GET['info'];
		$id_petugas=$_SESSION['id_petugas'];
		$select1=mysqli_query($connect, "UPDATE pembayaran SET id_petugas='$id_petugas' WHERE nisn='$nisn'");
		if ($select1) {
?>
			<script type="text/javascript">
				alert("Anda berhasil mengkonfirmasi pembayaran ini");
				document.location='../petugas/kirim_konfirmasi.php?info=<?=$nisn;?>';
			</script>
<?php
		}
		else{
?>
			<script type="text/javascript">
				alert("Gagal konfirmasi pembayaran ini");
				window.history.back();
			</script>
<?php
		}
	}
	else{
		header("location:../petugas/petugas.php?kategori=bayarspp");
	}
?>