<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$jumlah_semua = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user'"));
$jumlah_belum = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user' AND status = 'belum'"));
$jumlah_proses = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user' AND status = 'proses'"));
$jumlah_selesai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user' AND status = 'selesai'"));

if (isset($_GET['status'])) {
	$status = $_GET['status'];
	$kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user' AND status = '$status' ORDER BY tenggat_waktu ASC");
}
else 
{
	$kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user' ORDER BY tenggat_waktu ASC");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DAFTAR KEGIATAN</title>
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
		<h1>Daftar Kegiatan</h1>
		<ul class="horizontal-list">
		  <li><a href="index.php" class="button <?= (isset($_GET['status'])) ? 'bg-grey' : ''; ?>">Semua (<?= $jumlah_semua; ?>)</a></li>
		  <li><a href="index.php?status=belum" class="button <?= (isset($_GET['status']) && $_GET['status'] == 'belum') ? 'bg-red' : 'bg-grey'; ?>">Belum (<?= $jumlah_belum; ?>)</a></li>
		  <li><a href="index.php?status=proses" class="button <?= (isset($_GET['status']) && $_GET['status'] == 'proses') ? 'bg-yellow' : 'bg-grey'; ?>">Proses (<?= $jumlah_proses; ?>)</a></li>
		  <li><a href="index.php?status=selesai" class="button <?= (isset($_GET['status']) && $_GET['status'] == 'selesai') ? 'bg-blue' : 'bg-grey'; ?>">Selesai (<?= $jumlah_selesai; ?>)</a></li>
		</ul>


		<?php if (mysqli_num_rows($kegiatan)): ?>
			<?php foreach ($kegiatan as $data): ?>
				<div class="card">
					<?php if ($data['status'] == 'belum'): ?>
					  <a onclick="return confirm('Apakah Anda yakin ingin mengubah status kegiatan <?= $data['isi_kegiatan']; ?> menjadi proses?')" href="ubah_status.php?id_kegiatan=<?= $data['id_kegiatan']; ?>" class="card-status bg-red"><?= ucwords($data['status']); ?></a>
					<?php elseif ($data['status'] == 'proses'): ?>
					  <a onclick="return confirm('Apakah Anda yakin ingin mengubah status kegiatan <?= $data['isi_kegiatan']; ?> menjadi selesai?')" href="ubah_status.php?id_kegiatan=<?= $data['id_kegiatan']; ?>" class="card-status bg-yellow"><?= ucwords($data['status']); ?></a>
					<?php else: ?>
					  <a class="card-status bg-blue"><?= ucwords($data['status']); ?></a>
					<?php endif ?>
					<div class="card-content">
						<p><?= $data['isi_kegiatan']; ?></p>
					</div>
					<?php 
						$now = new DateTime();
						$deadline = new DateTime($data['tenggat_waktu']);
					 ?>
					<?php if ($now > $deadline): ?>
				    	<?php if ($data['status'] != 'selesai'): ?>
						  	<div class="card-deadline bg-red-card">
						    	<span>Tenggat Waktu:</span>
						    	<span>SUDAH TERLEWAT!!!</span>
					  		</div>
					  	<?php else: ?>
						  	<div class="card-deadline">
						    	<span>Tenggat Waktu:</span>
						    	<span><?= $data['tenggat_waktu']; ?></span>
					  		</div>
					  	<?php endif ?>
				  	<?php else: ?>
					  	<div class="card-deadline">
					    	<span>Tenggat Waktu:</span>
					    	<span><?= $data['tenggat_waktu']; ?></span>
				  		</div>
					<?php endif ?>
				  <div class="card-actions">
				    <a href="ubah_kegiatan.php?id_kegiatan=<?= $data['id_kegiatan']; ?>" class="button">Ubah</a>
					<a onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan <?= $data['isi_kegiatan']; ?>?')" href="hapus_kegiatan.php?id_kegiatan=<?= $data['id_kegiatan']; ?>" class="button bg-red">Hapus</a>
				  </div>
				</div>
			<?php endforeach ?>
		<?php else: ?>
			<h3>Belum ada kegiatan</h3>
			<a href="tambah_kegiatan.php" class="button">Tambah Kegiatan</a>
		<?php endif ?>
	</div>
</body>
</html>