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
                    <h1>User</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

<?php
  $query = "SELECT * from is_users ORDER BY nama_user ASC";
  $execQuery = mysqli_query($conn, $query)
               or die('Ada kesalahan pada query tampil data user: '.mysqli_error($conn));;
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus-square"></i> Tambah User
                      </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="center">No.</th>
                    <th class="center">Foto</th>
                    <th class="center">Username</th>
                    <th class="center">Nama User</th>
                    <th class="center">Hak Akses</th>
                    <th class="center">Status</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($execQuery)){
                      $id_user = $data['id_user'];
                    ?>
                      <tr>
                      <td><?=$id_user;?></td>
                      <?php
                        if ($data['foto']=="") { ?>
                            <td class='center'><img class='img-user' src='dist/img/user-default.png' width='45'></td>
                        <?php
                        } else { ?>
                            <td class='center'><img class='img-user' src='images/user/<?php echo $data['foto']; ?>' width='45'></td>
                        <?php
                        }
                      ?>
                      <td><?=$data['username']?></td>
                      <td><?=$data['nama_user']?></td>
                      <td><?=$data['hak_akses']?></td>
                      <td><?=$data['status']?></td>
                      <td>
                            <?php 
                                if ($data['status']=='aktif') { ?>
                                        <a data-toggle="tooltip" data-placement="top" title="Blokir" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/user/proses.php?act=off&id=<?php echo $data['id_user'];?>">
                                            <i class="fas fa-power-off" style="color: #ffffff;"></i>
                                        </a>
                            <?php
                            } 
                            else { ?>
                                <a data-toggle="tooltip" data-placement="top" title="Aktifkan" style="margin-right:5px" class="btn btn-success btn-sm" href="modules/user/proses.php?act=on&id=<?php echo $data['id_user'];?>">
                                    <i class="nav-icon fas fa-off"></i>
                                </a>
                            <?php
                            }
                            ?>
                                <a data-toggle="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="btn btn-success btn-sm" href="modules/user/proses.php?act=on&id=<?php echo $data['id_user'];?>">
                                        <i class="far fa-edit" style="color: #ffffff;"></i>
                                    </a>
                        </td>
                      </tr>
                    <?php
                    }

                    mysqli_close($conn);
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
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/user/proses.php?act=insert" method="post" enctype="multipart/form-data">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" required>
                <br>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <br>
                <label>Nama User</label>
                <input type="text" name="nama_user" placeholder="User" class="form-control" required>
                <br>
                <label>Hak Akses</label>
                <select class="form-control" name="hakakses" placeholder="Hak Akses" required>
                  <option value="Super Admin">Super Admin</option> 
                  <option value="User">User</option> 
                </select>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addUser" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div><!-- Modal Close -->
  
  <?php
  $execQuery = mysqli_query($conn, "SELECT * FROM is_users");
  while ($data = mysqli_fetch_array($execQuery)) {
    $id_user = $data['id_user'];
    $username = $data ['username'];
    $nama_user = $data ['nama_user'];
    $password = $data ['password'];
?>
  
    <!-- The Modal -->
    <div class="modal fade" id="edit<?=$id_user;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/user/proses.php?act=insert" method="post">
                <input type="text" name="id_user" placeholder="id_user" value="<?=$id_user?>" class="form-control" hidden>
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" value="<?=$username?>" class="form-control" required>
                <br>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" value="<?=$password?>" class="form-control" required>
                <br>
                <label>Nama User</label>
                <input type="text" name="nama_user" placeholder="User"  value="<?=$nama_user?>" class="form-control" required>
                <br>
                <label>Hak Akses</label>
                <select class="form-control" name="hakakses" placeholder="Hak Akses" required>
                  <option value="Super Admin">Super Admin</option> 
                  <option value="User">User</option> 
                </select>
                <br>
				    <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addUser" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div><!-- Modal Close -->

<?php
  }
?>