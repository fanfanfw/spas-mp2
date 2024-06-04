<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Load file koneksi.php
include "../koneksi.php";

// Load file autoload.php
require '../vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error_message = "";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = $_POST['namafile'];
    $path = '../tmp/' . $nama_file_baru; // Set tempat menyimpan file tersebut dimana

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($path); // Load file yang tadi diupload ke folder tmp
    $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$mahasiswa_nama = $row['B']; // Ambil data nama
		$mahasiswa_nim = $row['C']; // Ambil data nim
		$mahasiswa_password = $row['D']; // Ambil data password
        $encrypt_pwd = md5($mahasiswa_password);
		$mahasiswa_foto = $row['E']; // Ambil data foto

		// Cek jika semua data tidak diisi
		if($mahasiswa_nama == "" && $mahasiswa_nim == "" && $encrypt_pwd == "")
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Lakukan pengecekan apakah NIM sudah ada dalam database
			$check_query = "SELECT COUNT(*) AS total FROM mahasiswa WHERE mahasiswa_nim = '" . $mahasiswa_nim . "'";
			$check_result = mysqli_query($koneksi, $check_query);
			$check_data = mysqli_fetch_assoc($check_result);
			
			// Jika NIM sudah ada, tampilkan pesan kesalahan dan hentikan proses impor
			if($check_data['total'] > 0) {
			    $error_message = "NIM " . $mahasiswa_nim . " sudah ada dalam database!";
			    break;
			}
			
			// Jika NIM belum ada, lanjutkan dengan proses impor
			$query = "INSERT INTO mahasiswa (mahasiswa_nama, mahasiswa_nim, mahasiswa_password, mahasiswa_foto) VALUES ('" . $mahasiswa_nama . "','" . $mahasiswa_nim . "','" . $encrypt_pwd . "','" . $mahasiswa_foto . "')";

			// Eksekusi $query
			$result = mysqli_query($koneksi, $query);
            
            // Jika terjadi kesalahan saat mengeksekusi query, tangkap pesan kesalahan dan hentikan proses impor
            if(!$result) {
                $error_message = "Error: " . mysqli_error($koneksi);
                break;
            }
		}

		$numrow++; // Tambah 1 setiap kali looping
	}

    unlink($path); // Hapus file excel yg telah diupload, ini agar tidak terjadi penumpukan file
}

// Setelah selesai impor, redirect ke halaman utama
header('location: mahasiswa.php?error=' . urlencode($error_message));

// Tampilkan pesan kesalahan jika terjadi
if(!empty($error_message)) {
    echo "<script>alert('" . $error_message . "');</script>";
}
?>
