<?php include 'header.php'; ?>


<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Mahasiswa</h4>
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
    <div class="panel panel">

        <div class="panel-heading">
            <h3 class="panel-title">Data Mahasiswa</h3>
        </div>
        <div class="panel-body">

             <div class="pull-left">
                <a href="mahasiswa_import.php" class="btn btn-success">Import Mahasiswa</a>
            </div>

            <div class="pull-right">
                <a href="mahasiswa_tambah.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Mahasiwa</a>
            </div>

            <br>
            <br>
            <br>
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="5%">Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $mahasiswa = mysqli_query($koneksi,"SELECT * FROM mahasiswa ORDER BY mahasiswa_id DESC");
                    while($p = mysqli_fetch_array($mahasiswa)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php 
                                if($p['mahasiswa_foto'] == ""){
                                    ?>
                                    <img class="img-user" src="../gambar/sistem/user.png">
                                    <?php
                                }else{
                                    ?>
                                    <img class="img-user" src="../gambar/petugas/<?php echo $p['mahasiswa_foto']; ?>">
                                    <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $p['mahasiswa_nama'] ?></td>
                            <td><?php echo $p['mahasiswa_nim'] ?></td>
                            <td class="text-center">
                            <div class="modal fade" id="exampleModal_<?php echo $p['mahasiswa_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan dihapus secara permanen.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="mahasiswa_hapus.php?id=<?php echo $p['mahasiswa_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="btn-group">
                                    <a href="mahasiswa_edit.php?id=<?php echo $p['mahasiswa_id']; ?>" class="btn btn-default"><i class="fa fa-wrench"></i></a>                                    
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?php echo $p['mahasiswa_id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </div>
</div>

<script>
    // Fungsi untuk mendapatkan nilai dari parameter URL
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Ambil nilai dari parameter 'error' dalam URL
    var errorMessage = getParameterByName('error');
    
    // Jika ada pesan kesalahan, tampilkan dalam alert
    if (errorMessage) {
        alert(errorMessage);
        // Kembali ke URL semula setelah menekan tombol "OK"
        window.history.replaceState({}, document.title, window.location.href.split("?")[0]);
    }
</script>




<?php include 'footer.php'; ?>