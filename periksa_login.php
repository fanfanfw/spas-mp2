<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
$akses = $_POST['akses'];

if($akses == "admin"){

	$login = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['admin_id'];
		$_SESSION['nama'] = $data['admin_nama'];
		$_SESSION['username'] = $data['admin_username'];
		$_SESSION['status'] = "admin_login";

		header("location:admin/");
	}else{
		header("location:login.php?alert=gagal");
	}

}else{

	$login = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE mahasiswa_nim='$username' AND mahasiswa_password='$password'");
	$cek = mysqli_num_rows($login);

	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id'] = $data['mahasiswa_id'];
		$_SESSION['nama'] = $data['mahasiswa_nama'];
		$_SESSION['nim'] = $data['mahasiswa_nim'];
		$_SESSION['status'] = "mahasiswa_login";

		header("location:mahasiswa/");
	}else{
		header("location:login.php?alert=gagal");
	}

}
?>
sa