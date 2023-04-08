<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

if (isset($_POST['btnUbah'])) {
	$username = nl2br($_POST['username']);
	$nama_lengkap = $_POST['nama_lengkap'];

	// check username 
	$old_username = $data_user['username'];
	if ($username != $old_username) {
		$check_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
		if (mysqli_num_rows($check_username)) {
			echo "
				<script>
					alert('Username telah digunakan!')
					window.history.back();
				</script>
			";
			exit;
		}
	}


	$ubah_profile = mysqli_query($koneksi, "UPDATE user SET username = '$username', nama_lengkap = '$nama_lengkap' WHERE id_user='$id_user'");
	if ($ubah_profile) {
		echo "
			<script>
				alert('Profile berhasil diubah!')
				window.location.href='profile.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Profile gagal diubah!')
				window.location.href='profile.php'
			</script>
		";
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UBAH PROFILE</title>
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
		<button type="button" onclick="return window.history.back()" class="button">Kembali</button>
		<h1>Ubah Profile</h1>
		<form method="post">
			<div class="form-group">
				<label for="username" class="form-label">Isi Kegiatan</label>
				<input type="text" name="username" id="username" class="form-input" required value="<?= $data_user['username']; ?>">
			</div>
			<div class="form-group">
				<label for="nama_lengkap" class="form-label">Nama Lengkap</label>
				<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-input" required value="<?= $data_user['nama_lengkap']; ?>">
			</div>
			<div class="form-group">
				<button type="submit" name="btnUbah" class="button">Ubah</button>
			</div>
		</form>
	</div>
</body>
</html>