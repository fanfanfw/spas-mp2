<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Data Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip</span></li>
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
            <h3 class="panel-title">Semua Arsip</h3>
        </div>
        <div class="panel-body">

            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Waktu Upload</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <!-- <th>Arsip</th> -->
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Persetujuan</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $arsip = mysqli_query($koneksi,"SELECT * FROM arsip,kategori,mahasiswa WHERE arsip_petugas=mahasiswa_id and arsip_kategori=kategori_id ORDER BY arsip_id DESC");
                    while($p = mysqli_fetch_array($arsip)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo date('H:i:s  d-m-Y',strtotime($p['arsip_waktu_upload'])) ?></td>
                            <td><?php echo $p['mahasiswa_nama'] ?></td>
                            <td><?php echo $p['mahasiswa_nim'] ?></td>
                            <td><?php echo $p['kategori_nama'] ?></td>
                            <td><?php echo $p['arsip_keterangan'] ?></td>
                            <td class="text-center">
                            <span class="badge warning"><?php echo $p['status']?></span>
                            </td>
                            <td class="text-center">
                                <!-- PopUp Terima -->
                            <div class="modal fade" id="setujui_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="setujuiLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="setujuiLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin <b>Menyetujui</b> dokumen ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="arsip_approve.php?action=approve&id=<?php echo $p['arsip_id']; ?>" class="btn btn-success"><i class="fa fa-check"></i> &nbsp; Ya, terima</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PopUp Tolak -->
                            <div class="modal fade" id="tolak<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tolakLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin <b>Menolak</b> dokumen ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="arsip_approve.php?action=reject&id=<?php echo $p['arsip_id']; ?>" class="btn btn-danger"><i class="fa fa-times"></i> &nbsp; Ya, tolak</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
    // Periksa apakah status adalah "Diterima" atau "Ditolak"
    if ($p['status'] != 'Diterima' && $p['status'] != 'Ditolak') {
    ?>
        <!-- Tombol Setujui -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#setujui_<?php echo $p['arsip_id']; ?>">
            <i class="fa fa-check"></i>
        </button>

        <!-- Tombol Tolak -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolak<?php echo $p['arsip_id']; ?>">
            <i class="fa fa-times"></i>
        </button>
    <?php
    }
    ?>
                            </td>

                            <td class="text-center">
                                <div class="modal fade" id="exampleModal_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <a href="arsip_hapus.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-group">
                                    
                                    <a target="_blank" class="btn btn-default" href="../arsip/<?php echo $p['arsip_file']; ?>"><i class="fa fa-download"></i></a>
                                    <a target="_blank" href="arsip_preview.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-default"><i class="fa fa-search"></i> Preview</a>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_<?php echo $p['arsip_id']; ?>">
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


<?php include 'footer.php'; ?>