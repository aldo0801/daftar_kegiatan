<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$id_kegiatan = $_GET['id_kegiatan'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id_kegiatan' AND id_user = '$id_user'"));
if (isset($_POST['btnUbah'])) {
	$isi_kegiatan = $_POST['isi_kegiatan'];
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
</head>
<body>
	<h1>ubah kegiatan - <?= $data['isi_kegiatan']; ?></h1>
	<div>
		<form method="post">
			<div>
				<label for="isi_kegiatan">isi kegiatan</label>
				<textarea name="isi_kegiatan" id="isi_kegiatan"><?= $data['isi_kegiatan']; ?></textarea>
			</div>
			<div>
				<label for="tenggat_waktu">tenggat waktu</label>
				<input type="datetime-local" name="tenggat_waktu" id="tenggat_waktu" value="<?= $data['tenggat_waktu']; ?>">
			</div>
			<div>
				<label for="status">status</label>
				<select name="status" id="status">
					<option value="<?= $data['status']; ?>"><?= $data['status']; ?></option>
					<option value="belum">belum</option>
					<option value="proses">proses</option>
					<option value="selesai">selesai</option>
				</select>
			</div>
			<div>
				<button type="submit" name="btnUbah">ubah</button>
			</div>
		</form>
	</div>
</body>
</html>