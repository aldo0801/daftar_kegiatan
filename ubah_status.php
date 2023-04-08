<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_kegiatan = $_GET['id_kegiatan'];
$data_kegiatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'"));

if ($data_kegiatan['status'] == 'belum') {
	$ubah_kegiatan = mysqli_query($koneksi, "UPDATE kegiatan SET status = 'proses' WHERE id_kegiatan = '$id_kegiatan'");
} elseif ($data_kegiatan['status'] == 'proses') {
	$ubah_kegiatan = mysqli_query($koneksi, "UPDATE kegiatan SET status = 'selesai' WHERE id_kegiatan = '$id_kegiatan'");
}

if ($ubah_kegiatan) {
	echo "
		<script>
			alert('Kegiatan status berhasil diubah!')
			window.location.href='index.php'
		</script>
	";
	exit;
} else {
	echo "
		<script>
			alert('Kegiatan status gagal diubah!')
			window.location.href='index.php'
		</script>
	";
	exit;
}
?>