<section class="content-header">
      <div class="container-fluid">
      <?php
        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }
      ?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Jasa</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from jasa WHERE status = 'Y'";
  $execQuery = mysqli_query($conn, $query);
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus-square"></i> Tambah Jasa
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Jasa</th>
                    <th>Harga Jasa</th>
                    <th>History</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_jasa = $data['id_jasa'];
                      $jasa = $data['nama_jasa'];
                      $harga = $data ['harga_jasa'];
                      $formatted_harga = number_format($harga, 0, ',', '.');
                    ?>
                      <tr>
                      <td><?=$jasa?></td>
                      <td>Rp. <?=$formatted_harga?></td>
                      <!-- <td>
                        <a href="?module=historyPembelian&id_barang=<?=$id_barang?>" class = "btn btn-outline-primary" style="margin-right: 10px;">Pembelian</a>
                        <a href="?module=historyPenjualan&id_barang=<?=$id_barang?>" class = "btn btn-outline-danger">Penjualan</a>
                      </td> -->
                      <td>
                        <a href="?module=historyNamaJasa&id_jasa=<?=$id_jasa?>" class = "btn btn-outline-primary" style="margin-right: 10px;">History</a>
                      </td>
                      <td class="center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_jasa?>"><i class = "far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_jasa ;?>"><i class = "far fa-trash-alt"></i></button>
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
            <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Jasa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/jasa/proses.php?act=insert" method="post">
        
                
                <label>Nama Jasa</label>
                  <input type="text" name="namajasa" placeholder="Nama Jasa" class="form-control" required>
                
                <br>
        
                <label>Harga Jasa</label>
                  <input type="text" name="hargajasa" placeholder="Harga Jasa" class="form-control" required>
                
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addnewjasa" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
<?php
  $execQuery = mysqli_query($conn, "SELECT * FROM jasa");
  while ($data = mysqli_fetch_array($execQuery)) {
    $id_jasa = $data['id_jasa'];
    $jasa = $data ['nama_jasa'];
    $hargajasa = $data ['harga_jasa'];
?>
<div class="modal fade" id="edit<?=$id_jasa;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Jasa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/jasa/proses.php?act=edit" method="post">
                <input type="hidden" name="id_jasa" value="<?=$id_jasa;?>">
                <label>Nama Jasa</label>
                <input type="text" name="namajasa" value="<?=$jasa;?>" class="form-control" >
                <br>
                <label>Harga Jasa</label>
                <input type="text" name="hargajasa" value="<?=$hargajasa;?>" class="form-control" >
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editjasa" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
<!-- Delete Modal -->
<div class="modal fade" id="delete<?=$id_jasa;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Jasa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              Apakah anda ingin menghapus jasa?
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <form action="modules/master/jasa/proses.php?act=delete" method="post">
            <input type="hidden" name="id_jasa" value="<?=$id_jasa;?>">
            <button type="submit" class="btn btn-primary" name="deletejasa">Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </form> 
        </div>
      </div>
    </div>
  </div>
<?php
  }mysqli_close($conn);
?>