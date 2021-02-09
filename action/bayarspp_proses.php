<?php
session_start();
	include 'koneksi.php';
	$nisn=$_SESSION['nisn'];
	$tgl=date('y-m-d');
	$bln=date('m');
	$thn=date('y');
	$id_spp=$_SESSION['id_spp'];
	$jml_byr=$_POST['value'];
	$eml_pembyr=$_POST['email'];
	$telp_pembyr=$_POST['telp'];
	$mtd_pembyr=$_POST['mtd_byr'];
	$s_spp=mysqli_query($connect, "SELECT * FROM spp WHERE id_spp='$_SESSION[id_spp]'");
	$nominal=mysqli_fetch_array($s_spp);
	
	if ($_SESSION['nama']=='') {
		header("location:../login.php?pesan=curang");
	}
	elseif (isset($_GET['status'])) {
		if ($_GET['status']=='nyicil') {
			$hsl_jml_byr=$jml_byr*2;
			$stt_byr="Lunas";
			$query_byr=mysqli_query($connect, "UPDATE pembayaran SET id_petugas=NULL, tgl_bayar='$tgl',bulan_bayar='$bln',tahun_bayar='$thn',jumlah_bayar='$hsl_jml_byr',status_bayar='$stt_byr',email_pembayar='$eml_pembyr',telp_pembayar='$telp_pembyr',metode_pembayaran='$mtd_pembyr',no_transaksi=NULL WHERE nisn='$nisn'");
		}
	}
	else{
		if ($jml_byr>=$nominal['nominal']) {
			$stt_byr="Lunas";
		}
		else{
			$stt_byr="Belum Lunas";
		}
		$query_byr=mysqli_query($connect, "INSERT INTO pembayaran (nisn,tgl_bayar,bulan_bayar,tahun_bayar,id_spp,jumlah_bayar,status_bayar,email_pembayar,telp_pembayar,metode_pembayaran) VALUES ('$nisn','$tgl','$bln','$thn','$id_spp','$jml_byr','$stt_byr','$eml_pembyr','$telp_pembyr','$mtd_pembyr')");
		}
	if ($query_byr) {
		header("location:../siswa/transfer_uang.php?metode=$mtd_pembyr");
	}
	else{
?>
<script type="text/javascript">
	alert("Gagal mengirim FORM. Coba beberapa saat lagi.");
	window.history.back();
</script>
<?php
	}
?>