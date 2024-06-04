<?php 
include '../koneksi.php';
session_start();

$id = $_SESSION['id'];

$nim  = $_POST['nim'];
$nama  = $_POST['nama'];

$rand = rand();

$allowed =  array('gif','png','jpg','jpeg');

$filename = $_FILES['foto']['name'];

if($filename == ""){

	mysqli_query($koneksi, "update mahasiswa set mahasiswa_nama='$nama', mahasiswa_nim='$nim' where mahasiswa_id='$id'")or die(mysqli_error($koneksi));
	header("location:profil.php?alert=sukses");

}else{

	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(in_array($ext,$allowed) ) {

		// hapus file lama
		$lama = mysqli_query($koneksi,"select * from mahasiswa where mahasiswa_id='$id'");
		$l = mysqli_fetch_assoc($lama);
		$nama_file_lama = $l['petugas_foto'];
		unlink("../gambar/petugas/".$nama_file_lama);

		// upload file baru
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/petugas/'.$rand.'_'.$filename);
		$nama_file = $rand.'_'.$filename;
		mysqli_query($koneksi, "update mahasiswa set mahasiswa_nama='$nama', mahasiswa_nim='$nim', mahasiswa_foto='$nama_file' where mahasiswa_id='$id'")or die(mysqli_error($koneksi));
		header("location:profil.php?alert=sukses");

	}else{

		header("location:profil.php?alert=gagal");
	}

}

