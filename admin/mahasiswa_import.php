<?php
include 'header.php';
require '../vendor/autoload.php'; // Menggunakan autoload dari Composer
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; // Menggunakan namespace dari PhpSpreadsheet
?>


<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Tambah Mahasiswa</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Mahasiswa</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-10">
            <div class="panel panel">

                <div class="panel-heading">
                    <h3 class="panel-title">Import Mahasiswa</h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">            
                        <a href="mahasiswa.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="pull-left">            
                    <a target="_blank" class="btn btn-sm btn-success" href="../format_import/format_import_datamahasiswa.xlsx">Download Format Import</a>
                    </div>
                    

                    <br>
                    <br>
                    <br>
                    <br>

                    <form method="post" action="mahasiswa_import.php" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Pilih file Excel untuk diunggah:</label>
                            <input type="file" name="file">
                            
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <label></label>
                            <input type="submit" class="btn btn-primary" name="preview" value="Preview">
                        </div>

                    </form>
                    <hr>
                    <?php
                    // Jika user telah mengklik tombol Preview
                    if (isset($_POST['preview'])) {
                        $tgl_sekarang = date('YmdHis'); // Ini akan mengambil waktu sekarang dengan format yyyymmddHHiiss
                        $nama_file_baru = 'data' . $tgl_sekarang . '.xlsx';

                    // Cek apakah terdapat file data.xlsx pada folder tmp
                    if (is_file('../tmp/' . $nama_file_baru)) // Jika file tersebut ada
                        unlink('../tmp/' . $nama_file_baru); // Hapus file tersebut

                    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
                    $tmp_file = $_FILES['file']['tmp_name'];

                    // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
                    if ($ext == "xlsx") {
                        // Upload file yang dipilih ke folder tmp
                        // dan rename file tersebut menjadi data{tglsekarang}.xlsx
                        // {tglsekarang} diganti jadi tanggal sekarang dengan format yyyymmddHHiiss
                        // Contoh nama file setelah di rename : data20210814192500.xlsx
                        move_uploaded_file($tmp_file, '../tmp/' . $nama_file_baru);

                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        $spreadsheet = $reader->load('../tmp/' . $nama_file_baru); // Load file yang tadi diupload ke folder tmp
                        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                        // Buat sebuah tag form untuk proses import data ke database
                        echo "<form method='post' action='import.php'>";

            // Disini kita buat input type hidden yg isinya adalah nama file excel yg diupload
            // ini tujuannya agar ketika import, kita memilih file yang tepat (sesuai yg diupload)
            echo "<input type='hidden' name='namafile' value='" . $nama_file_baru . "'>";

            // Buat sebuah div untuk alert validasi kosong
            echo "<div id='kosong' style='color: red;margin-bottom: 10px;'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                </div>";

            echo "<table border='1' cellpadding='5'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>Nama</th>
						<th>NM</th>
						<th>Password</th>
					</tr>";

            $numrow = 1;
            $kosong = 0;
            foreach ($sheet as $row) { // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
                $mahasiswa_nama = $row['B']; // Ambil data nama
                $mahasiswa_nim = $row['C']; // Ambil data jenis kelamin
                $mahasiswa_password = $row['D']; // Ambil data telepon
                $mahasiswa_foto = $row['E']; // Ambil data alamat

                // Cek jika semua data tidak diisi
                if ( $mahasiswa_nama == "" && $mahasiswa_nim == "" && $mahasiswa_password == "")
                    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if ($numrow > 1) {
                    // Validasi apakah semua data telah diisi
                    $nama_td = (!empty($mahasiswa_nama)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                    $nim_td = (!empty($mahasiswa_nim)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                    $pwd_td = (!empty($mahasiswa_password)) ? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah

                    // Jika salah satu data ada yang kosong
                    if ($mahasiswa_nama == "" or $mahasiswa_nim == "" or $mahasiswa_password == "") {
                        $kosong++; // Tambah 1 variabel $kosong
                    }

                    echo "<tr>";
                    echo "<td" . $nama_td . ">" . $mahasiswa_nama . "</td>";
                    echo "<td" . $nim_td . ">" . $mahasiswa_nim . "</td>";
                    echo "<td" . $pwd_td . ">" . $mahasiswa_password . "</td>";
                    echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
            }

            echo "</table>";

            // Cek apakah variabel kosong lebih dari 0
            // Jika lebih dari 0, berarti ada data yang masih kosong
            if ($kosong > 0) {
    ?>
                <script>
                    $(document).ready(function() {
                        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                        $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                        $("#kosong").show(); // Munculkan alert validasi kosong
                    });
                </script>
        <?php
            } else { // Jika semua data sudah diisi
                echo "<hr>";

                // Buat sebuah tombol untuk mengimport data ke database
                // echo "<button type='button' name='import' class='btn btn-primary'>Simpan</button>";
                echo "<button type='submit' name='import'>Import</button>";

            }
            echo "</form>";
        } else { // Jika file yang diupload bukan File Excel 2007 (.xlsx)
            // Munculkan pesan validasi
            echo "<div style='color: red;margin-bottom: 10px;'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
                </div>";
        }
    }
    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>