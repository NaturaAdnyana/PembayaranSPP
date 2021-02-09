	<?php
session_start();
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
	}
	else{
		include 'koneksi.php';

		$nisn=$_SESSION['nisn'];
		$no_transaksi=$_POST['no_transaksi'];
		$query_transaksi=mysqli_query($connect, "UPDATE pembayaran SET no_transaksi='$no_transaksi' WHERE nisn='$nisn'");
		if ($query_transaksi) {
?>
<script type="text/javascript">
	alert("Anda telah berhasil membayar SPP");
	document.location='../siswa/sukses_bayarspp.php';
</script>
<?php
		}
		else{
?>
<script type="text/javascript">
	alert("Gagal mengirim no. transaksi. Cobalah beberapa saat lagi");
	window.history.back();
</script>
<?php
		}
	}
?>