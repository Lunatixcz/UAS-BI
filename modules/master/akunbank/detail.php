<section class="content-header">
    <div class="container-fluid">
    <?php
  if (isset($_GET['alert'])) {
    $alert =  $_GET['alert'];
    switchAlert($alert);
    }
    if (isset($_GET['id_tipe'])) {
        $id_tipe =  $_GET['id_tipe'];
    }
    ?>

<?php
    $query = "SELECT * FROM tipe_akun where id_tipe = $id_tipe";
    $execQuery = mysqli_query($conn, $query);
    while ($dataakun = mysqli_fetch_array($execQuery)) {
        $tipe_akun  = $dataakun['tipe_akun'];
        $nomor_akun  = $dataakun['nomor_akun'];
    } 
?>


        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?=$tipe_akun?> - <?=$nomor_akun?>  </h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#tambah">
                        <i class="fa fa-plus-square"></i> Tambah Sub-Bank Account
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Nomor Akun</th>
                                <th>Nama Akun</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM akun where tipe_akun = $id_tipe";
                                $execQuery = mysqli_query($conn, $query);
                                while ($data = mysqli_fetch_array($execQuery)) {
                                    $id_akun  = $data['id_akun'];
                                    $kode_akun  = $data['kode_akun'];
                                    $nama_akun  = $data['nama_akun'];
                                    $kredit = number_format($data['kredit'], 0); // Format 'kredit' with 2 decimal places
                                    $debit = number_format($data['debit'], 0); // Format 'debit' with 2 decimal places
                                    ?>
                                    <tr>
                                        <td><?=$kode_akun?></td>
                                        <td><?=$nama_akun?></td>
                                        <td><?=$debit?></td>
                                        <td><?=$kredit?></td>
                                        <td>
                                            <a href="?module=historyAkun&id_akun=<?=$id_akun?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_akun;?>"><i class = "far fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_akun?>"><i class = "far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Insert Modal -->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Bank Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->

        <div class="modal-body">
            <br>
            <form action="modules/master/akunbank/proses.php?act=insertsubacc" method="post">
                <?php
                    $query = "SELECT a.nomor_transaksi AS last_transaksi, t.tipe_akun , t.nomor_akun
                                FROM akun a
                                JOIN tipe_akun t ON a.tipe_akun = t.id_tipe
                                WHERE a.tipe_akun = '$id_tipe'
                                AND a.nomor_transaksi = (
                                    SELECT MAX(nomor_transaksi)
                                    FROM akun
                                    WHERE id_tipe = '$id_tipe'
                                )";
                    $execQuery = mysqli_query($conn, $query);
                    if ($execQuery && mysqli_num_rows($execQuery) > 0) {
                        $fetchQuery = mysqli_fetch_array($execQuery);
                        // Increment the next number by 1 if the current month is the same as the stored month
                        $next_number = (int)$fetchQuery['last_transaksi'] + 1;
                        $newAkun = $nomor_akun . '-' . $next_number;
                    } else {
                        // Handle the case when no rows are returned or an error occurred
                        // Set a default value or show an error message
                        $next_number = 1;
                        $newAkun = $nomor_akun . '-' . '1';
                    }        
                ?>
                <input type="text" name="id_tipe" value="<?=$id_tipe?>" placeholder="Nomor Akun" class="form-control" hidden>
                <input type="text" name="no_trans" value="<?=$next_number?>" placeholder="Nomor Akun" class="form-control" hidden>

                <label>Tipe Akun</label>
                <input type="text" value="<?=$tipe_akun?>-<?=$nomor_akun?>" placeholder="Nomor Akun" class="form-control" readonly>
                <br>
                <label>Nomor Akun</label>
                <input type="text" name="nomor_akun" value="<?=$newAkun?>" placeholder="Nomor Akun" class="form-control" readonly>
                <br>
                <label>Nama Akun</label>
                <input type="text" name="nama_akun" placeholder="Nama Akun" class="form-control" required>
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addsubAcc" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
<?php

    $execQuery = mysqli_query($conn, "SELECT * FROM akun");

    while ($data = mysqli_fetch_array($execQuery)) {
        $id_akun = $data['id_akun'];
        $kode_akun = $data['kode_akun'];
        $nama_akun = $data['nama_akun'];
?>

<div class="modal fade" id="edit<?=$id_akun;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Sub Bank Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/akunbank/proses.php?act=edit" method="post">
                <input type="hidden" name="id_tipe" value="<?=$id_tipe;?>">
                <label>Tipe Akun</label>
                <input type="text" name="tipe_akun" value="<?=$tipe_akun;?>" class="form-control" >
                <br>
                <label>Nomor Akun</label>
                <input type="text" name="nomor_akun" value="<?=$nomor_akun;?>" class="form-control" required>
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="editAcc" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
    
<!-- Delete Modal -->
<div class="modal fade" id="delete<?=$id_supplier;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
                Apakah Anda Ingin Menghapus Supplier <?=$namasupplier;?> ?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <form action="modules/master/supplier/proses.php?act=delete" method="post">
            <input type="hidden" name="idupdtsup" value="<?=$idsup?>">
            <button type="submit" class="btn btn-primary" name="delSup">Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>           

  <?php
    }
    mysqli_close($conn);
  ?>