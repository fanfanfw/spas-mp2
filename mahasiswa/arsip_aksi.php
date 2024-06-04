<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$waktu = date('Y-m-d H:i:s'); 
$petugas = $_SESSION['id'];
$kode  = $_POST['kode'];
$nama  = $_POST['nama'];

$rand = rand();

$filename = $_FILES['file']['name'];
$jenis = pathinfo($filename, PATHINFO_EXTENSION);

$kategori = $_POST['kategori'];
$keterangan = $_POST['keterangan'];

// Periksa apakah 'status' ada dalam $_POST, jika tidak, gunakan nilai default 'Pending'
$status = isset($_POST['status']) ? $_POST['status'] : 'Pending';

if($jenis == "php") {
    header("location:arsip.php?alert=gagal");
} else {
    move_uploaded_file($_FILES['file']['tmp_name'], '../arsip/'.$rand.'_'.$filename);
    $nama_file = $rand.'_'.$filename;
    mysqli_query($koneksi, "INSERT INTO arsip (arsip_waktu_upload, arsip_petugas, arsip_kode, arsip_nama, arsip_jenis, arsip_kategori, arsip_keterangan, arsip_file, status) 
                            VALUES ('$waktu', '$petugas', '$kode', '$nama', '$jenis', '$kategori', '$keterangan', '$nama_file', '$status')") 
                            or die(mysqli_error($koneksi));
    header("location:arsip.php?alert=sukses");
}
?>
