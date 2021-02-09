<!DOCTYPE html>
<html>
<head>
	<title>Login Petugas</title>
	<link rel="stylesheet" type="text/css" href="this.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/brands.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/solid.css">
</head>
<body>
	<?php
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan']=="gagal") {
	?>
				<script type="text/javascript">
					alert("Username atau Password anda salah");
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
		<div class="login_form_petugas">
			<div class="costumer_img">
				<img src="img/customer-service.svg">
			</div>
			<h1>LOGIN</h1>
			<h2>PETUGAS</h2>
			<form method="post" action="action/login_proses_petugas.php">
				<input type="text" name="username" placeholder="username" required="" autocomplete="off"><br>
				<input type="password" name="password" placeholder="password" required=""><br>
				<input type="submit" name="" value="LOGIN">
			</form>
			<a href="login.php"><i class="fas fa-chevron-left"></i> Kembali</a>
		</div>
	</div>
<?php
	include 'footer.php';
?>
</body>
</html>