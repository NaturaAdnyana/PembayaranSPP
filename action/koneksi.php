<?php 
$connect=mysqli_connect("localhost", "root", "", "db_spp");
if (mysqli_connect_errno()) {
	echo "Gagal koneksi dengan Database : ".mysqli_connect_errno();
}
 ?>