<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_kegiatan = $_GET['id_kegiatan'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id_kegiatan' AND id_user = '$id_user'"));
if (isset($_POST['btnUbah'])) {
	$isi_kegiatan = nl2br($_POST['isi_kegiatan']);
	$tenggat_waktu = $_POST['tenggat_waktu'];
	$status = $_POST['status'];

	$ubah_kegiatan = mysqli_query($koneksi, "UPDATE kegiatan SET isi_kegiatan = '$isi_kegiatan', tenggat_waktu = '$tenggat_waktu', status = '$status' WHERE id_kegiatan = '$id_kegiatan' AND id_user='$id_user'");
	if ($ubah_kegiatan) {
		echo "
			<script>
				alert('kegiatan berhasil diubah!')
				window.location.href='index.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('kegiatan gagal diubah!')
				window.location.href='index.php'
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
	<title>UBAH KEGIATAN - <?= $data['isi_kegiatan']; ?></title>
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
		<h1>Ubah Kegiatan - <?= $data['isi_kegiatan']; ?></h1>
		<form method="post">
			<div class="form-group">
				<label for="isi_kegiatan" class="form-label">Isi Kegiatan</label>
				<textarea name="isi_kegiatan" id="isi_kegiatan" required class="form-input"><?= strip_tags($data['isi_kegiatan']); ?></textarea>
			</div>
			<div class="form-group">
				<label for="tenggat_waktu" class="form-label">Tenggat Waktu</label>
				<input type="datetime-local" name="tenggat_waktu" id="tenggat_waktu" class="form-input" required value="<?= $data['tenggat_waktu']; ?>">
			</div>
			<div class="form-group">
				<label for="status" class="form-label">Status</label>
				<select name="status" id="status" class="form-input">
					<option value="<?= $data['status']; ?>"><?= $data['status']; ?></option>
					<option value="belum">belum</option>
					<option value="proses">proses</option>
					<option value="selesai">selesai</option>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" name="btnUbah" class="button">Ubah</button>
			</div>
		</form>
	</div>
</body>
</html>