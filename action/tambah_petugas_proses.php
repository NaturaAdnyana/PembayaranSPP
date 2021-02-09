<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	elseif ($_SESSION['level']=='petugas') {
		header("location:petugas.php?kategori=bayarspp");
	}
	include '../action/koneksi.php';

	$username=$_POST['username'];
	$password=$_POST['password'];
	$nama=$_POST['nama'];
	$no_telp_petugas=$_POST['no_telp_petugas'];
	$level=$_POST['level'];

	$tambah=mysqli_query($connect, "INSERT INTO petugas VALUES ('','$username','$password','$nama','$no_telp_petugas','$level')");
	if ($tambah) {
?>
		<script type="text/javascript">
			alert("Berhasil tambahkan <?=$nama;?> sebagai petugas baru");
			document.location="../petugas/info_petugas.php";
		</script>
<?php
	}
	else{
?>
		<script type="text/javascript">
			alert("Gagal tambahkan <?=$nama;?> sebagai petugas baru");
			window.history.back();
		</script>
<?php
	}
?>