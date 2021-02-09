<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="this.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/brands.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/solid.css">
</head>
<body>
	<?php
		if (isset($_GET['pesan'])){
			if ($_GET['pesan']=="gagal") {
	?>
	<script type="text/javascript">
		alert("NISN anda Salah");
	</script>
	<?php
			}
			elseif ($_GET['pesan']=="curang") {
	?>
	<script type="text/javascript">
		alert("Anda harus LOGIN terlebih dahulu");
	</script>
	<?php
			}
		}
	?>
	<div class="sheet1">
		<img src="img/logo_program.png">
		<div class="login_form">
			<h1>LOGIN</h1>
			<form method="post" action="action/login_proses.php">
				<input type="text" name="nisn" placeholder="NISN" autocomplete="off" required
				<?php
					if (isset($_GET['pesan'])){
						if ($_GET['pesan']=="gagal") {
				?>
				style="background-color: #FF000F69; border-radius: 2px;"
				<?php
						}
					}
				?>
				><br>
				<input type="submit" name="submit" value="LOGIN">
			</form>
			<h4>Bermasalah saat login? Hubungi : 083115155885</h4>
			<a href="index.php" class="login_back"><i class="fas fa-chevron-left"></i> Kembali</a>
			<a href="login_petugas.php" class="login_petugas">Masuk sebagai petugas <i class="fas fa-user-tie"></i></a>
		</div>
	</div>
	<div class="contact" align="center" title="Contact Us">
		<img src="img/costumer.svg" align="center">
		<a href="https://api.whatsapp.com/send?phone=6281111111111&text=Ask%20SPP%20ONESKA%0A-" title="Contact Us"><i class="fab fa-whatsapp"></i></a>
		<a href="tel:+62361943414"><i class="fas fa-phone-alt"></i></a>
	</div>
<?php
	include 'footer.php';
?>
</body>
</html>