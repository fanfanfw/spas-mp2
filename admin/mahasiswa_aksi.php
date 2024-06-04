<?php 
include '../koneksi.php';

// Tangkap data dari form
$nama  = $_POST['nama'];
$nim = $_POST['nim'];
$password = md5($_POST['password']);

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

// Jika tidak ada file yang diupload
if($filename == ""){
    // Lakukan pengecekan apakah NIM sudah ada dalam database
	$check_query = "SELECT COUNT(*) AS total FROM mahasiswa WHERE mahasiswa_nim = '$nim'";
	$check_result = mysqli_query($koneksi, $check_query);
	$check_data = mysqli_fetch_assoc($check_result);
	
	// Jika NIM sudah ada, tampilkan pesan kesalahan
	if($check_data['total'] > 0) {
	    header("location:mahasiswa.php?error=NIM sudah ada dalam database!");
	    exit; // Hentikan eksekusi skrip jika terjadi kesalahan
	}
	
    // Jika NIM belum ada, lanjutkan dengan proses insert
	mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES (NULL,'$nama','$nim','$password','')");
	header("location:mahasiswa.php");
} else {
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	// Jika ekstensi file tidak diizinkan
	if(!in_array($ext, $allowed)) {
		header("location:mahasiswa.php?alert=gagal");
		exit; // Hentikan eksekusi skrip jika terjadi kesalahan
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/petugas/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		
		// Lakukan pengecekan apakah NIM sudah ada dalam database
		$check_query = "SELECT COUNT(*) AS total FROM mahasiswa WHERE mahasiswa_nim = '$nim'";
		$check_result = mysqli_query($koneksi, $check_query);
		$check_data = mysqli_fetch_assoc($check_result);
		
		// Jika NIM sudah ada, tampilkan pesan kesalahan
		if($check_data['total'] > 0) {
		    header("location:mahasiswa.php?error=NIM sudah ada dalam database!");
		    exit; // Hentikan eksekusi skrip jika terjadi kesalahan
		}
		
		// Jika NIM belum ada, lanjutkan dengan proses insert
		mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES (NULL,'$nama','$nim','$password','$file_gambar')");
		header("location:mahasiswa.php");
	}
}
?>
