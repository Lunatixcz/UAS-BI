<section class="content-header">
    <div class="container-fluid">
    <?php
        if (isset($_GET['alert'])) {
            $alert =  $_GET['alert'];
            switchAlert($alert);
    }
    // if (isset($_GET['alert'])) {
    //     $alert =  $_GET['alert'];
    //     switchAlert($alert);
// }
?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Mobil</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-md-end">
                        <a href="main.php?module=detailMobil">
                            <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-plus-square"></i> Tambah Mobil
                            </button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Merk Mobil</th>
                                <th>Tanggal Periksa</th>
                                <th>No polisi</th>
                                <th>Pemeriksa</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM data_mobil where status = 'Y'";
                                $execQuery = mysqli_query($conn, $query);

                                while ($data = mysqli_fetch_array($execQuery)){
                                    $id_mobil = $data ['id_mobil'];
                                    $merk = $data ['merk'];
                                    $plat = $data ['plat'];
                                    $tanggal  = $data ['tanggal'];
                                    $pemeriksa  = $data ['pemeriksa'];
                                ?>
                                <tr>
                                    <td><?=$merk?></td>
                                    <td><?=$tanggal?></td>
                                    <td><?=$plat?></td>
                                    <td><?=$pemeriksa?></td>
                                   
                                    
                                    <td class="center">
                                            <a href="?module=detailMobil&id_mobil=<?=$id_mobil?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_perlengkapan;?>"><i class = "far fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_perlengkapan;?>"><i class = "far fa-trash-alt"></i></button>
                                        </td>  
                                    
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                </table>
                <br><br>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

<!-- The Modal -->
<?php
    $query = "SELECT id_pembelian FROM pembelian";
    $execQuery = mysqli_query($conn, $query);

    while ($data = mysqli_fetch_array($execQuery)){
    $id_pembelian = $data ['id_pembelian'];
    ?>
  <div class="modal fade" id="bayar<?=$id_pembelian?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pembelian</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/transaksi/pembelian/proses.php?act=buy" method="post">
                <p>Selesaikan Pembayaran?</p>
                <input type="hidden" name="id_pembelian" value="<?=$id_pembelian;?>">
                <select name="id_akun" class="form-control">
                <?php
                $query = "SELECT * FROM akun";
                    $execQuery = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($execQuery)){
                    $id_akun = $data ['id_akun'];
                    $kode_akun = $data ['kode_akun'];
                    $nama_akun = $data ['nama_akun'];
                ?>
                    <option value="<?= $id_akun; ?>">
                        <?= $nama_akun;?>
                    <?php
                    }
                ?>
                </select>
                <br>
                <br>
                <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="buy" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
  <?php
    }mysqli_close($conn)
?>