<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];

if (isset($_POST['btnTambah'])) {
	$isi_kegiatan = $_POST['isi_kegiatan'];
	$tenggat_waktu = $_POST['tenggat_waktu'];

	$tambah_kegiatan = mysqli_query($koneksi, "INSERT INTO kegiatan VALUES ('', '$id_user', '$isi_kegiatan', '$tenggat_waktu', 'belum')");

	if ($tambah_kegiatan) {
		echo "
			<script>
				alert('kegiatan berhasil ditambahkan!')
				window.location.href='index.php'
			</script>
		";
		exit;
	} else {
		echo "
			<script>
				alert('kegiatan gagal ditambahkan!')
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
	<title>TAMBAH KEGIATAN</title>
</head>
<body>
	<h1>tambah kegiatan</h1>
	<div>
		<form method="post">
			<div>
				<label for="isi_kegiatan">isi kegiatan</label>
				<textarea name="isi_kegiatan" id="isi_kegiatan"></textarea>
			</div>
			<div>
				<label for="tenggat_waktu">tenggat waktu</label>
				<input type="datetime-local" name="tenggat_waktu" id="tenggat_waktu">
			</div>
			<div>
				<button type="submit" name="btnTambah">tambah</button>
			</div>
		</form>
	</div>
</body>
</html>