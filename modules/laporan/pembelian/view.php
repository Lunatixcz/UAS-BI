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
                    <h1>Buy Report</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-start">
                    <h4>Rekap Excel Pembelian</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                          <div class="col-3">
                              <label>Pilih Akun</label>
                          </div>
                          <div class="col-3">
                              <label>Tanggal Awal</label>
                          </div>
                          <div class="col-1 mt-2" style="display: flex; justify-content: center;">    
                          </div>
                          <div class="col-3">
                              <label>Tanggal Akhir</label>
                          </div>
                      </div>

                  <form role="form" action="modules/laporan/penjualan/excel.php" method="GET">
                    <div class="row mt-2">

                            <div class="col-3">
                              <select name="id_akun" class="form-control">
                                    <?php
                                    $query = "SELECT nama_akun , id_akun , kode_akun FROM akun";
                                        $execQuery = mysqli_query($conn, $query);
                                        while ($data = mysqli_fetch_array($execQuery)){
                                            $id_akun = $data ['id_akun'];
                                            $kode_akun = $data ['kode_akun'];
                                            $nama_akun = $data ['nama_akun'];
                                    ?>
                                        <option value="<?= $id_akun; ?>">
                                            <?= $nama_akun;?> - (<?= $kode_akun;?>)
                                        <?php
                                        }
                                    ?>
                              </select>
                            </div>

                            <div class="col-3">
                                <input type="date" name="tgl_awal" placeholder="tanggal_awal" class="form-control" required>
                            </div>
                            <div class="col-1 mt-2" style="display: flex; justify-content: center;">
                                -
                            </div>
                            <div class="col-3">
                                <input type="date" name="tgl_akhir" placeholder="tanggal_akhir" class="form-control" required>
                            </div>
                            <div class="col-1 mt-1">
                                <button type="submit" class="btn btn-success btn-sm" ><i class = "fas fa-file-excel"></i>&nbsp;&nbsp;&nbsp;Excel</button>
                            </div>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
         <!-- /.row -->
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-md-flex justify-content-md-start">
                    <h4>Rekap Excel Cash Keluar</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                          <div class="col-3">
                              <label>Pilih Akun</label>
                          </div>
                          <div class="col-3">
                              <label>Tanggal Awal</label>
                          </div>
                          <div class="col-1 mt-2" style="display: flex; justify-content: center;">    
                          </div>
                          <div class="col-3">
                              <label>Tanggal Akhir</label>
                          </div>
                      </div>

                  <form role="form" action="modules/laporan/penjualan/excel.php" method="GET">
                    <div class="row mt-2">

                            <div class="col-3">
                              <select name="id_akun" class="form-control">
                                    <?php
                                    $query = "SELECT nama_akun , id_akun , kode_akun FROM akun";
                                        $execQuery = mysqli_query($conn, $query);
                                        while ($data = mysqli_fetch_array($execQuery)){
                                            $id_akun = $data ['id_akun'];
                                            $kode_akun = $data ['kode_akun'];
                                            $nama_akun = $data ['nama_akun'];
                                    ?>
                                        <option value="<?= $id_akun; ?>">
                                            <?= $nama_akun;?> - (<?= $kode_akun;?>)
                                        <?php
                                        }
                                    ?>
                              </select>
                            </div>

                            <div class="col-3">
                                <input type="date" name="tgl_awal" placeholder="tanggal_awal" class="form-control" required>
                            </div>
                            <div class="col-1 mt-2" style="display: flex; justify-content: center;">
                                -
                            </div>
                            <div class="col-3">
                                <input type="date" name="tgl_akhir" placeholder="tanggal_akhir" class="form-control" required>
                            </div>
                            <div class="col-1 mt-1">
                                <button type="submit" class="btn btn-success btn-sm" ><i class = "fas fa-file-excel"></i>&nbsp;&nbsp;&nbsp;Excel</button>
                            </div>
                    </div>
                </form>
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
