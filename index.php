<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}
$id_user = $_SESSION['id_user'];
$kegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE id_user = '$id_user'");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DAFTAR KEGIATAN</title>
</head>
<body>
	<div>
		<a href="tambah_kegiatan.php">tambah kegiatan</a>
		<a href="logout.php">Logout</a>
		<table border="1" cellpadding="10" cellspacing="0">
			<thead>
				<tr>
					<th>no</th>
					<th>isi kegiatan</th>
					<th>tenggat waktu</th>
					<th>status</th>
					<th>aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($kegiatan as $data): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['isi_kegiatan']; ?></td>
						<td><?= $data['tenggat_waktu']; ?></td>
						<td><?= $data['status']; ?></td>
						<td>
							<a href="ubah_kegiatan.php?id_kegiatan=<?= $data['id_kegiatan']; ?>">ubah</a>
							<a onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan <?= $data['isi_kegiatan']; ?>?')" href="hapus_kegiatan.php?id_kegiatan=<?= $data['id_kegiatan']; ?>">hapus</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>