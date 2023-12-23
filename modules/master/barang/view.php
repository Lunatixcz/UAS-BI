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
                    <h1>Item</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from barang WHERE status = 'Y'";
  $execQuery = mysqli_query($conn, $query);
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#tambahBarang">
                          <i class="fa fa-plus-square"></i> Tambah Barang
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Satuan Besar</th>
                    <th>Satuan Kecil</th>
                    <th>Harga Modal</th>
                    <th>Quantity</th>
                    <th>History</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_barang = $data['id_barang'];
                      $barang = $data ['nama_barang'];
                      $uombesar = $data ['uom_besar'];
                      $uomkecil = $data ['uom_kecil'];
                      $satuanbesar = $data ['satuan_besar'];
                      $satuankecil = $data ['satuan_kecil'];
                      $harga_modal = $data ['harga_modal'];
                      $formatted_harga_modal = number_format($harga_modal, 0, ',', '.');
                      $kuantitas = number_format($data ['kuantitas'], 0, ',', '.');
                    ?>
                      <tr>
                      <td><?=$barang?></td>
                      <td><?=$satuanbesar?> <?=$uombesar?></td>
                      <td><?=$satuankecil?> <?=$uomkecil?></td>
                      <td>Rp. <?=$formatted_harga_modal?></td>
                      <td><?=$kuantitas?></td>
                      <td>
                        <a href="?module=historyPembelian&id_barang=<?=$id_barang?>" class = "btn btn-outline-primary" style="margin-right: 10px;">Pembelian</a>
                        <a href="?module=historyPenjualan&id_barang=<?=$id_barang?>" class = "btn btn-outline-danger">Penjualan</a>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_barang;?>"><i class = "far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_barang;?>"><i class = "far fa-trash-alt"></i></button>
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
    </section>
        <!-- /.row -->
            <!-- The Modal -->
  <div class="modal fade" id="tambahBarang">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/barang/proses.php?act=insert" method="post">
              <div class="row">
                <div class="col-12">
                <label>Nama Barang</label>
                  <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                </div>
              </div>

              <div class="row" style="margin-top: 24px;">
                <div class="col-6">    
                  <label>Satuan Besar</label>
                  <input type="text" name="satuanbesar" placeholder="Satuan Besar" class="form-control addbesar_mask" oninput="formatNumber('addbesar_mask')" required>
                </div>   
                <div class="col-6">   
                  <label>UOM Besar</label>
                  <input type="text" name="uombesar" placeholder="UOM Besar" class="form-control" required>
                </div>    
              </div>  

              <div class="row" style="margin-top: 24px;">
                <div class="col-6">    
                  <label>Satuan Kecil</label>
                  <input type="text" name="satuankecil" placeholder="Satuan Kecil" class="form-control addkecil_mask" oninput="formatNumber('addkecil_mask')" required>
                </div>   
                <div class="col-6">   
                  <label>UOM Kecil</label>
                  <input type="text" name="uomkecil" placeholder="UOM Kecil" class="form-control" required>
                </div>    
              </div>  
               
              <div class="row" style="margin-top: 24px;">
                <div class="col-12">
                <label>Harga Modal</label>
                  <input type="text" name="hargamodal" placeholder="Harga Modal" class="form-control hargamodal_mask" oninput="formatCurrency('hargamodal_mask')" required>
                </div>
              </div>

                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addnewbarang" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
<?php
  $execQuery = mysqli_query($conn, "SELECT * FROM barang");
  while ($data = mysqli_fetch_array($execQuery)) {
    $id_barang = $data['id_barang'];
    $barang = $data ['nama_barang'];
    $uombesar = $data ['uom_besar'];
    $uomkecil = $data ['uom_kecil'];
    $satuanbesar = $data ['satuan_besar'];
    $satuankecil = $data ['satuan_kecil'];
    $harga_modal = $data ['harga_modal'];
    $kuantitas = $data ['kuantitas'];
?>
<div class="modal fade" id="edit<?=$id_barang;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/barang/proses.php?act=edit" method="post">
            <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
            <div class="row">
                <div class="col-12">
                <label>Nama Barang</label>
                  <input type="text" name="namabarang" value="<?=$barang;?>" placeholder="Nama Barang" class="form-control" required>
                </div>
              </div>

              <div class="row" style="margin-top: 24px;">
                <div class="col-6">    
                  <label>Satuan Besar</label>
                  <input type="text" name="satuanbesar"  value="<?=$satuanbesar;?>" placeholder="Nama Barang" class="form-control" required>
                </div>   
                <div class="col-6">   
                  <label>UOM Besar</label>
                  <input type="text" name="uombesar"  value="<?=$uombesar;?>" placeholder="UOM" class="form-control" required>
                </div>    
              </div>  

              <div class="row" style="margin-top: 24px;">
                <div class="col-6">    
                  <label>Satuan Kecil</label>
                  <input type="text" name="satuankecil"  value="<?=$satuankecil;?>" placeholder="Nama Barang" class="form-control" required>
                </div>   
                <div class="col-6">   
                  <label>UOM Kecil</label>
                  <input type="text" name="uomkecil"  value="<?=$uomkecil;?>" placeholder="UOM" class="form-control" required>
                </div>    
              </div>  
               
              <div class="row" style="margin-top: 24px;">
                <div class="col-12">
                <label>Harga Modal</label>
                  <input type="text" name="hargamodal"  value="<?=$harga_modal;?>" placeholder="Nama Barang" class="form-control" required>
                </div>
              </div>

                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="editbarang" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
<!-- Delete Modal -->
<div class="modal fade" id="delete<?=$id_barang;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              Apakah anda ingin menghapus barang?
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <form action="modules/master/barang/proses.php?act=delete" method="post">
            <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
            <button type="submit" class="btn btn-primary" name="deletebarang">Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </form> 
        </div>
      </div>
    </div>
  </div>
<?php
  }
  mysqli_close($conn);
?>