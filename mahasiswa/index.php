<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Dashboard</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="traffice-source-area mg-b-30">
    <div class="container-fluid">
        <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info-cs">
            <h3 class="box-title">Jumlah Surat Saya</h3>
            <ul class="list-inline two-part-sp">
            <li>
                <div id="sparklinedash"></div>
            </li>
            <li class="text-right sp-cn-r">
                <span class="counter text-success">
                    <?php 

                    $id = $_SESSION['id'];
                      $query = "SELECT COUNT(*) AS jumlah_surat_diterima 
                              FROM arsip 
                              WHERE arsip_petugas = $id;
                            --   AND status = 'Ditolak'";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    $jumlah_surat_diterima = $row['jumlah_surat_diterima'];

                    // menampilkan jumlah surat yang diterima
                    echo $jumlah_surat_diterima;
                    ?>
                </span>
            </li>
        </ul>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info-cs">
            <h3 class="box-title">Surat Pending</h3>
            <ul class="list-inline two-part-sp">
            <li>
                <div id="sparklinedash2"></div>
            </li>
            <li class="text-right sp-cn-r">
                <span class="counter text-success">
                    <?php 

                    $id = $_SESSION['id'];
                      $query = "SELECT COUNT(*) AS jumlah_surat_diterima 
                              FROM arsip 
                              WHERE arsip_petugas = $id
                               AND status = 'Pending'";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    $jumlah_surat_diterima = $row['jumlah_surat_diterima'];

                    // menampilkan jumlah surat yang diterima
                    echo $jumlah_surat_diterima;
                    ?>
                </span>
            </li>
        </ul>
    </div>
</div>





            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <h3 class="box-title">Surat Diterima</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash3"></div>
                        </li>
                        <li class="text-right graph-three-ctn">
                        <span>
                        <?php 
    
                        $id = $_SESSION['id'];
                          $query = "SELECT COUNT(*) AS jumlah_surat_diterima 
                                  FROM arsip 
                                  WHERE arsip_petugas = $id
                                   AND status = 'Diterima'";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        $jumlah_surat_diterima = $row['jumlah_surat_diterima'];
    
                        // menampilkan jumlah surat yang diterima
                        echo $jumlah_surat_diterima;
                        ?>
                    </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <h3 class="box-title">Surat Ditolak</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash4"></div>
                        </li>
                        <li class="text-right graph-four-ctn">
                        <span">
                        <?php 
    
                        $id = $_SESSION['id'];
                          $query = "SELECT COUNT(*) AS jumlah_surat_diterima 
                                  FROM arsip 
                                  WHERE arsip_petugas = $id
                                   AND status = 'Ditolak'";
                        $result = mysqli_query($koneksi, $query);
                        $row = mysqli_fetch_assoc($result);
                        $jumlah_surat_diterima = $row['jumlah_surat_diterima'];
    
                        // menampilkan jumlah surat yang diterima
                        echo $jumlah_surat_diterima;
                        ?>
                    </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Grafik pengunduhan surat</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p>Grafik jumlah unduh surat perhari selama sebulan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline cus-product-sl-rp">
                        <li>
                            <h5><i class="fa fa-circle" style="color: #006DF0;"></i>Jumlah Unduhan</h5>
                        </li>
                    </ul>
                    <div id="extra-area-chart" style="height: 356px;"></div>


                    <div id="morris-area-chart"></div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                <?php 
                $id = $_SESSION['id'];
                $saya = mysqli_query($koneksi,"select * from mahasiswa where mahasiswa_id='$id'");
                $s = mysqli_fetch_assoc($saya);
                ?>
                <div class="single-cards-item">
                    <div class="single-product-image">
                        <a href="#">
                            <img src="../assets/img/product/profile-bg.jpg" alt="">
                        </a>
                    </div>

                    <div class="single-product-text">
                        <?php 
                        if($s['mahasiswa_foto'] == ""){
                            ?>
                            <img class="img-user" src="../gambar/sistem/user.png">
                            <?php
                        }else{
                            ?>
                            <img class="img-user" src="../gambar/petugas/<?php echo $s['mahasiswa_foto']; ?>">
                            <?php
                        }
                        ?>

                        <h4><a class="cards-hd-dn" href="#"><?php echo $s['mahasiswa_nama']; ?></a></h4>
                        <h5>Mahasiswa</h5>
                        <p class="ctn-cards">Pengelolaan surat jadi lebih mudah dengan sistem pengelolaan administrasi surat.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>