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
                    <h1>Perlengkapan Mobil</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from mobil WHERE status = 'Y'";
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
                          <i class="fa fa-plus-square"></i> Tambah Perlengkapan
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Perlengkapan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_perlengkapan = $data ['id_prlkpn'];
                      $perlengkapan = $data ['prlkpn'];
                    ?>
                      <tr>
                      <td><?=$i?>.</td>z
                      <td><?=$perlengkapan?></td>
                      <td class="center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_perlengkapan;?>"><i class = "far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_perlengkapan;?>"><i class = "far fa-trash-alt"></i></button>
                      </td>
                      </tr>
                    <?php
                    $i++;
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
          <h4 class="modal-title">Tambah Perlengkapan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/mobil/proses.php?act=insert" method="post">
              <div class="row">
                <div class="col-12">
                <label>Nama Perlengkapan</label>
                  <input type="text" name="namaperlengkapan" placeholder="Nama Perlengkapan" class="form-control" required>
                </div>
              </div>
                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addnewperlengkapan" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
<?php
  $execQuery = mysqli_query($conn, "SELECT * FROM mobil");
  while ($data = mysqli_fetch_array($execQuery)) {
    $id_perlengkapan = $data['id_prlkpn'];
    $perlengkapan = $data ['prlkpn'];
?>
<div class="modal fade" id="edit<?=$id_perlengkapan;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Perlengkapan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/master/mobil/proses.php?act=edit" method="post">
            <input type="hidden" name="id_perlengkapan" value="<?=$id_perlengkapan;?>">
            <div class="row">
                <div class="col-12">
                <label>Nama Perlengkapan</label>
                  <input type="text" name="namaperlengkapan" value="<?=$perlengkapan;?>" placeholder="Nama Perlengkapan" class="form-control" required>
                </div>
              </div>

                <br>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="editperlengkapan" style="float: right;">Submit</button>
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
  }mysqli_close($conn);
?>