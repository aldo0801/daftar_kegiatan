<?php 
session_start();
date_default_timezone_set("Asia/Jakarta");
$host="localhost";
$user="root";
$pass="";
$db="daftar_kegiatan";
$koneksi=mysqli_connect($host,$user,$pass,$db);
if ($koneksi) {
	// echo "berhasil";
}
 ?>