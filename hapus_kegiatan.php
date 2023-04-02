<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$id_kegiatan = $_GET['id_kegiatan'];

$hapus_kegiatan = mysqli_query($koneksi, "DELETE FROM kegiatan WHERE id_kegiatan = '$id_kegiatan' AND id_user = '$id_user'");
if ($hapus_kegiatan) {
	echo "
		<script>
			alert('kegiatan berhasil dihapus!')
			window.location.href='index.php'
		</script>
	";
	exit;
} else {
	echo "
		<script>
			alert('kegiatan gagal dihapus!')
			window.location.href='index.php'
		</script>
	";
	exit;
}
?>