<?php
session_start();
	if ($_SESSION['nama_petugas']=='') {
		header("location:../login_petugas.php?pesan=curang");
	}
	include '../action/koneksi.php';

	if ($_GET['info']) {
		$nisn=$_GET['info'];
		$nisn2=$_POST['nisn'];
		$nis=$_POST['nis'];
		$nama=$_POST['nama'];
		$id_kelas=$_POST['id_kelas'];
		$alamat=$_POST['alamat'];
		$no_telp=$_POST['no_telp'];
		$id_spp=$_POST['id_spp'];
		$edit=mysqli_query($connect, "UPDATE siswa SET nisn='$nisn2', nis='$nis', nama='$nama', id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp', id_spp='$id_spp' WHERE nisn='$nisn'");
		if ($edit) {
?>
			<script type="text/javascript">
				alert("Berhasil edit siswa");
				document.location='../petugas/info_siswa.php';
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
		header("location:../petugas/info_siswa.php");
	}
?>