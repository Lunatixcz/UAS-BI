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
                    <h1>Pihak Jasa</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from pihak_jasa WHERE status = 'Y'";
  $execQuery = mysqli_query($conn, $query);
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#tambahJasa">
                          <i class="fa fa-plus-square"></i> Tambah Nama
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>History</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                        while($data = mysqli_fetch_assoc($execQuery)){
                          $id_pjasa = $data['id_pjasa'];
                          $nama = $data['nama_pihak'];
                          $kontak = $data['kontak'];
                          $alamat = $data['alamat'];

                          ?>
                          <tr>
                            <td><?=$nama?></td>
                            <td><?=$kontak?></td>
                            <td><?=$alamat?></td>
                            <td>
                            <a href="?module=historyPihakJasa&id_pjasa=<?=$id_pjasa?>" class = "btn btn-outline-primary" style="margin-right: 10px;">History</a>
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?=$id_pjasa;?>"><i class = "far fa-edit"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id_pjasa;?>"><i class = "far fa-trash-alt"></i></button>
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

<div class="modal fade" id="tambahJasa">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header">
      <h4 class="modal-title">Tambah Pihak Jasa</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
      <br>
      <form action="modules/master/pihakJasa/proses.php?act=insert" method="post">
        <div class="row">
          <div class="col-12">
            <label>Nama : </label>
            <input type="text" name="namaPihak" placeholder="Nama" class="form-control" required>
          </div>
        </div>

        <div class="row" style="margin-top: 24px;">
          <div class="col-12">
            <label>Kontak : </label>
            <input type="text" name="kontak" placeholder="Kontak" class="form-control">
          </div>
        </div>

        <div class="row" style="margin-top: 24px;">
          <div class="col-12">
            <label>Alamat : </label>
            <input type="text" name="alamat" placeholder="Alamat" class="form-control">
          </div>
        </div>

        <br><br>
        <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addPihakJasa" style="float: right;">Submit</button>
      </form>
    </div>
    </div>
  </div>
</div>

<?php
  $execQuery = mysqli_query($conn, "SELECT * FROM pihak_jasa");
  while ($data = mysqli_fetch_array($execQuery)){
    $id_pihak = $data['id_pjasa'];
    $nama = $data['nama_pihak'];
    $kontak = $data['kontak'];
    $alamat = $data['alamat'];
?>

<div class="modal fade" id="edit<?=$id_pihak?>">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

    <div class="modal-header">
      <h4 class="modal-title">Edit Pihak Jasa</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
      <br>
      <form action="modules/master/pihakJasa/proses.php?act=edit" method="post">
        <input type="hidden" name="id_pjasa" value="<?=$id_pihak?>">
      <div class="row">
          <div class="col-12">
            <label>Nama : </label>
            <input type="text" name="namaPihak" placeholder="Nama" class="form-control" required value="<?=$nama?>">
          </div>
        </div>

        <div class="row" style="margin-top: 24px;">
          <div class="col-12">
            <label>Kontak : </label>
            <input type="text" name="kontak" placeholder="Kontak" class="form-control"- value="<?=$kontak?>">
          </div>
        </div>

        <div class="row" style="margin-top: 24px;">
          <div class="col-12">
            <label>Alamat : </label>
            <input type="text" name="alamat" placeholder="Alamat" class="form-control" value="<?=$alamat?>">
          </div>
        </div>
        <br><br>
        <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editJasa" style="float: right;">Submit</button>
      </form>
    </div>

    </div>
  </div>
</div>

<div class="modal fade" id="delete<?=$id_pihak;?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Hapus Pihak</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              Apakah anda ingin menghapus Pihak Jasa?
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <form action="modules/master/pihakJasa/proses.php?act=delete" method="post">
            <input type="hidden" name="id_pjasa" value="<?=$id_pihak;?>">
            <button type="submit" class="btn btn-primary" name="deletePihak">Yes</button>
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