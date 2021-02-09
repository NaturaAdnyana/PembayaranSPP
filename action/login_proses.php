<?php 
$nisn=$_POST['nisn'];

include 'koneksi.php';

$user=mysqli_query($connect, "SELECT * FROM siswa WHERE nisn='$nisn'");
$cek=mysqli_num_rows($user);
if($cek>0){
	session_start();
	$row=mysqli_fetch_array($user);
	$_SESSION['nama']=$row['nama'];
	$_SESSION['nisn']=$row['nisn'];
	$_SESSION['nis']=$row['nis'];
	$_SESSION['id_kelas']=$row['id_kelas'];
	$_SESSION['alamat']=$row['alamat'];
	$_SESSION['no_telp']=$row['no_telp'];
	$_SESSION['id_spp']=$row['id_spp'];
?>
<script type="text/javascript">
	alert("Anda Berhasil Login");
	document.location='../siswa/siswa.php';
</script>
<?php
}
else{
	header("location:../login.php?pesan=gagal");
}
 ?>