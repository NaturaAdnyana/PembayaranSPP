<?php
$username=$_POST['username'];
$password=$_POST['password'];

include 'koneksi.php';

$user=mysqli_query($connect, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
$cek=mysqli_num_rows($user);
if ($cek>0) {
	session_start();
	$row=mysqli_fetch_array($user);
	if ($row['level']=="admin") {
		$_SESSION['id_petugas']=$row['id_petugas'];
		$_SESSION['username']=$row['username'];
		$_SESSION['nama_petugas']=$row['nama_petugas'];
		$_SESSION['level']=$row['level'];
		$nm_pet=$_SESSION['nama_petugas'];
?>
<script type="text/javascript">
	alert("Selamat Datang <?php echo $nm_pet;?> ;)");
	document.location='../petugas/petugas.php?kategori=bayarspp';
</script>
<?php
	}
	elseif ($row['level']=="petugas") {
		$_SESSION['id_petugas']=$row['id_petugas'];
		$_SESSION['username']=$row['username'];
		$_SESSION['nama_petugas']=$row['nama_petugas'];
		$_SESSION['level']=$row['level'];
		$nm_pet=$_SESSION['nama_petugas'];
?>
<script type="text/javascript">
	alert("Selamat Datang Petugas <?php echo $nm_pet;?>");
	document.location='../petugas/petugas.php?kategori=bayarspp';
</script>
<?php
	}
}
else{
	header("location:../login_petugas.php?pesan=gagal");
}
?>