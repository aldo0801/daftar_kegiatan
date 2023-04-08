<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

if (isset($_POST['btnUbah'])) {
	$password_lama = htmlspecialchars($_POST['password_lama']);
	$password_baru = htmlspecialchars($_POST['password_baru']);
	$verifikasi_password_baru = htmlspecialchars($_POST['verifikasi_password_baru']);

	// check password with verify
	if ($password_baru != $verifikasi_password_baru) {
		echo "
			<script>
				alert('Password baru harus sama dengan verifikasi password baru!');
				window.history.back();
			</script>
		";
		exit;
	}

	// check password lama
	if (!password_verify($password_lama, $data_user['password'])) {
		echo "
			<script>
				alert('Password lama tidak sesuai!');
				window.history.back();
			</script>
		";
		exit;
	}

	$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

	$ubah_password = mysqli_query($koneksi, "UPDATE user SET password = '$password_baru' WHERE id_user = '$id_user'");

	if ($ubah_password) {
		echo "
			<script>
				alert('Password berhasil diubah!');
				window.location.href='profile.php';
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('Password gagal diubah!');
				window.history.back();
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
	<title>UBAH PASSWORD</title>
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
		<h1>Ubah Password</h1>
		<form method="post">
			<div class="form-group">
				<label for="password_lama" class="form-label">Password Lama</label>
				<input type="password" name="password_lama" id="password_lama" class="form-input" required>
			</div>
			<div class="form-group">
				<label for="password_baru" class="form-label">Password Baru</label>
				<input type="password" name="password_baru" id="password_baru" class="form-input" required>
			</div>
			<div class="form-group">
				<label for="verifikasi_password_baru" class="form-label">Verifikasi Password Baru</label>
				<input type="password" name="verifikasi_password_baru" id="verifikasi_password_baru" class="form-input" required>
			</div>
			<div class="form-group">
				<button type="submit" name="btnUbah" class="button">Ubah</button>
			</div>
		</form>
	</div>
</body>
</html>