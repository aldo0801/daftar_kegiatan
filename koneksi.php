<?php 
session_start();

$host="localhost";
$user="root";
$pass="";
$db="daftar_kegiatan";
$koneksi=mysqli_connect($host,$user,$pass,$db);
if ($koneksi) {
	// echo "berhasil";
}
 ?>