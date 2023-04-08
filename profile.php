<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PROFILE</title>
	<link rel="icon" href="img/logo.jpg">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
	  <ul>
	    <li><a href="profile.php">Selamat Datang, <?= $data_user['nama_lengkap']; ?></a></li>
	    <li><a href="index.php">Daftar Kegiatan</a></li>
	    <li><a href="tambah_kegiatan.php">Tambah Kegiatan</a></li>
	    <li class="right"><a href="logout.php">Logout</a></li>
	  </ul>
	</nav>
	<div class="container">
		<h1>Profile</h1>
		<table>
		  <tr>
		    <td>Username</td>
		    <td>: <?= $data_user['username']; ?></td>
		  </tr>
		  <tr>
		    <td>Nama Lengkap</td>
		    <td>: <?= $data_user['nama_lengkap']; ?></td>
		  </tr>
		</table>
		<br>
		<a href="ubah_profile.php" class="button">Ubah Profile</a>
		<a href="ubah_password.php" class="button">Ubah Password</a>

	</div>
</body>
</html>