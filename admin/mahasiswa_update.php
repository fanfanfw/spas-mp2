<?php 
include '../koneksi.php';

$id  = $_POST['id'];
$nama  = $_POST['nama'];
$nim = $_POST['nim'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);

// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

// Lakukan pengecekan apakah NIM sudah ada dalam database
$check_query = "SELECT COUNT(*) AS total FROM mahasiswa WHERE mahasiswa_nim = '$nim' AND mahasiswa_id != '$id'";
$check_result = mysqli_query($koneksi, $check_query);
$check_data = mysqli_fetch_assoc($check_result);

// Jika NIM sudah ada, tampilkan pesan kesalahan
if($check_data['total'] > 0) {
    header("location:mahasiswa.php?error=NIM sudah ada dalam database!");
    exit; // Hentikan eksekusi skrip jika terjadi kesalahan
}

if($pwd=="" && $filename==""){
	mysqli_query($koneksi, "UPDATE mahasiswa SET mahasiswa_nama='$nama', mahasiswa_nim='$nim' WHERE mahasiswa_id='$id'");
	header("location:mahasiswa.php");
} elseif($pwd==""){
	if(!in_array($ext,$allowed) ) {
		header("location:mahasiswa.php?alert=gagal");
		exit; // Hentikan eksekusi skrip jika terjadi kesalahan
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/petugas/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "UPDATE mahasiswa SET mahasiswa_nama='$nama', mahasiswa_nim='$nim', mahasiswa_foto='$x' WHERE mahasiswa_id='$id'");		
		header("location:mahasiswa.php?alert=berhasil");
	}
} elseif($filename==""){
	mysqli_query($koneksi, "UPDATE mahasiswa SET mahasiswa_nama='$nama', mahasiswa_nim='$nim', mahasiswa_password='$password' WHERE mahasiswa_id='$id'");
	header("location:mahasiswa.php");
}
?>
