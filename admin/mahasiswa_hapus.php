<?php 
include '../koneksi.php';
$id = $_GET['id'];

$data = mysqli_query($koneksi, "select * from mahasiswa where mahasiswa_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['mahasiswa_foto'];
unlink("../gambar/petugas/$foto");
mysqli_query($koneksi, "delete from mahasiswa where mahasiswa_id='$id'");
header("location:mahasiswa.php");
