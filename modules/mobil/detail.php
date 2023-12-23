<?php
if (isset($_GET['id_mobil'])) { ?>
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Mobil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
  $id_mobil = $_GET['id_mobil'];
  $execQuery = mysqli_query($conn, "SELECT *
                                    FROM data_mobil
                                    JOIN history_mobil ON data_mobil.id_mobil= history_mobil.id_mobil
                                    WHERE data_mobil.id_mobil = $id_mobil;");
  while ($data = mysqli_fetch_array($execQuery)){
    $id_mobil = $data ['id_mobil'];
    $merk = $data ['merk'];
    $plat = $data ['plat'];
    $tanggal  = $data ['tanggal'];
    $pemeriksa  = $data ['pemeriksa'];
?>
<!-- Mulai content -->
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h2>
                    
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
      <?php
        }
      ?>   
      <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                      <label>Merk Mobil</label>
                      <input type="text" name="merk" placeholder="Merk Mobil" value="<?=$merk?>" class="form-control" readonly>
                      <br>
                      <label>No Polisi</label>
                      <input type="text" name="plat" placeholder="No Polisi" value="<?=$plat?>" class="form-control" readonly>
                      <br>
                      <label>Tanggal Periksa</label>
                      <input type="date" id="tanggal_periksa" name="tanggal_periksa" placeholder="Tanggal Periksa" value="<?=$tanggal?>" class="form-control" readonly>
                      <br>
                      <label>Pemeriksa</label>
                      <input type="text" name="pemeriksa" placeholder="Pemeriksa" value="<?=$pemeriksa?>" class="form-control" readonly>
                      <br>
                    </div>
                  </div>
                  <br>     
<!-- form tutup -->
                <br>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <h3>List Perlengkapan :</h3>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Perlengkapan</th>
                      <th>Kondisi</th>
                      <th>Deskripsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        $execQuery = mysqli_query($conn, "SELECT *
                                                          FROM data_mobil
                                                          JOIN history_mobil ON data_mobil.id_mobil= history_mobil.id_mobil
                                                          JOIN mobil ON mobil.id_prlkpn = history_mobil.id_perlengkapan
                                                          WHERE data_mobil.id_mobil = $id_mobil;");
                        while ($data = mysqli_fetch_array($execQuery)){
                            $id_mobil = $data ['id_mobil'];
                            $prlkpn = $data ['prlkpn'];
                            $kondisi = $data ['kondisi'];
                            $perlengkapan  = $data ['perlengkapan'];
                    ?>
                    <tr>
                        <td><?=$i?></>
                        <td><?=$prlkpn?></td>
                        <td><?=$kondisi?></td>
                        <td><?=$perlengkapan?></td>
                    </tr>
                    <?php
                    $i++;
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <br><br><br>
              <style>
                .row-spacing{
                  padding-top: 100px;
                }
              </style>
              <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                  <table class="table-bordered w-100">
                    <thead>
                      <tr>
                        <th colspan="2"  class="text-center"><h4>Tanda Tangan</h4></th>
                      </tr>
                      <tr>
                        <th class="text-center"><h5>Masuk</h5></th>
                        <th class="text-center"><h5>Keluar</h5></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="row-spacing-bottom">Tanggal :</td>
                        <td class="row-spacing-bottom">Tanggal :</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;CUSTOMER&#41;</td>
                        <td class="text-center row-spacing">&#40;CUSTOMER&#41;</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;MEKANIK&#41;</td>
                        <td class="text-center row-spacing">&#40;MEKANIK&#41;</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;PIC&#41;</td>
                        <td class="text-center row-spacing">&#40;PIC&#41;</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;DIAPPROVE&#41;</td>
                        <td class="text-center row-spacing">&#40;DIAPPROVE&#41;</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col">
                  <a href="?module=detailPembelian" rel="noopener" target="_blank" class="btn btn-default float-left  " onclick="printPage()"><i class="fas fa-print"></i> Print</a>
                    <script>
                    function printPage() {
                      window.addEventListener("load", window.print());
                    }
                    </script>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
  <?php 
      } 
  else  { ?>
      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Mobil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Mulai content -->
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h2>
                    
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row">
                
                  <?php
                  if (!isset($_SESSION['temp_transaksi_mobil'])) {/* pengulangan pertama */
                  ?>
                  <div class="col-sm-4 invoice-info">
                    <form action="modules/mobil/proses.php?act=inserttemp" method="post"> <!-- form buka -->
                      <label>Merk Mobil</label>
                      <input type="text" name="merk" placeholder="Merk Mobil" class="form-control">
                      <br>
                      <label>No Polisi</label>
                      <input type="text" name="plat" placeholder="No Polisi" class="form-control">
                      <br>
                      <label>Tanggal Periksa</label>
                      <input type="date" id="tanggal_periksa" name="tanggal_periksa" placeholder="Tanggal Periksa" class="form-control" required>
                      <br>
                      <label>Pemeriksa</label>
                      <input type="text" name="pemeriksa" placeholder="Pemeriksa" class="form-control">
                      <br>
                      <label>Servis</label>
                      <input type="text" name="servis" placeholder="Servis" class="form-control">
                      <br>
                    </div>
                  </div>
                  <div class="row" style="margin : 24px 0 0 2px">
                      <button type="button" name="reset" class="btn btn-secondary align-items-center" onclick="window.location.href='modules/mobil/proses.php?act=reset'" style="height : 50px" disabled>Reset</button>
                  </div>
                  <br>
                  <?php
                  } else { 
                    $merk = $_SESSION['temp_transaksi_mobil']['merk'];
                    $plat = $_SESSION['temp_transaksi_mobil']['plat'];
                    $tanggal_periksa = $_SESSION['temp_transaksi_mobil']['tanggal_periksa'];
                    $pemeriksa = $_SESSION['temp_transaksi_mobil']['pemeriksa'];
                    $servis = $_SESSION['temp_transaksi_mobil']['servis'];
                    $perlengkapan_array = $_SESSION['temp_data_perlengkapan'];
                  ?>
                  <div class="col-sm-4 invoice-col">
                  <form action="modules/mobil/proses.php?act=inserttemp" method="post"> 
                    <!-- form buka -->
                      <label>Merk Mobil</label>
                      <input type="text" name="merk" value='<?=$merk?>' class="form-control" readonly>
                      <br>
                      <label>No Polisi</label>
                      <input type="text" name="plat" value='<?=$plat?>' class="form-control" readonly>
                      <br>
                      <label>Tanggal Periksa</label>
                      <input type="date" name="tanggal_periksa" value='<?=$tanggal_periksa?>' class="form-control" readonly>
                      <br>
                      <label>Pemeriksa</label>
                      <input type="text" name="pemeriksa" value='<?=$pemeriksa?>' class="form-control" readonly>
                      <br>
                      <label>Servis</label>
                      <input type="text" name="pemeriksa" value='<?=$servis?>' class="form-control" readonly>
                      <br>
                    </div>
                    <div class="col-sm-2 invoice-col d-md-flex justify-content-md-end">
                  </div>
                  </div>
                  <div class="row" style="margin: 24px 0 0 2px">
                      <button type="button" name="reset" class="btn btn-primary align-items-center" onclick="window.location.href='modules/mobil/proses.php?act=reset'" style="height : 50px">Reset</button>
                    </div>
                  <br>
                  
                  <?php
                  }
                  ?>
                
              <!-- /.row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nama Perlengkapan</th>
                      <th>Deskripsi</th>
                      <th>Kondisi</th>
                      <th>Submit</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>
                      <select name="id_perlengkapan" class="form-control">
                        <?php
                        $pilihanbarang = mysqli_query($conn, "select * from mobil WHERE status = 'Y'");
                        while ($fetcharray = mysqli_fetch_array($pilihanbarang)) {
                          $perlengkapan = $fetcharray['prlkpn'];
                          $perlengkapan_id = $fetcharray['id_prlkpn']; // use a different variable name here
                        ?>
                          <option value="<?= $perlengkapan_id; ?>">
                            <?= $perlengkapan; ?>
                          </option>
                        <?php
                        }
                        ?>
                      </select>
                      </td>

                      <td>
  <input type="radio" id="perlengkapan-ada" name="perlengkapan" value="Ada">
  <label for="perlengkapan-ada">Ada</label>

  <input type="radio" id="perlengkapan-tidakada" name="perlengkapan" value="Tidak ada">
  <label for="perlengkapan-tidakada">Tidak Ada</label>
</td>

<td id="kondisi-container">
  <input type="radio" id="kondisi-baik" name="kondisi" value="Baik">
  <label for="kondisi-baik">Baik</label>

  <input type="radio" id="kondisi-rusak" name="kondisi" value="Rusak">
  <label for="kondisi-rusak">Rusak</label>
</td>
      
      
      <td>
        <div class="row">
          <div class = "col">
              <button type="submit" name="inserttemp" class="btn btn-outline-secondary" onclick="clearIsiHeaderAdded()">
                Tambah
              </button>
          </div>
      </div>
    </td>
        </tr>
    </tbody>
  </table>
</div>
</div>
</form>
<!-- form tutup -->
                <br>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <h3>List Perlengkapan :</h3>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Perlengkapan</th>
                      <th>Kondisi</th>
                      <th>Deskripsi</th>
                      <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!isset($_SESSION['temp_data_perlengkapan'])) {
                      ?>
                      <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                      </tr>
                      <?php
                    } else {
                      $i = 1;
                      foreach ($_SESSION['temp_data_perlengkapan'] as $key => $value){   
                        $id_perlengkapan = $value['id_perlengkapan'];
                        $query = "SELECT prlkpn FROM mobil WHERE $id_perlengkapan = id_prlkpn";
                        $ambilPerlengkapan= mysqli_query($conn, $query);
                        $fetchPerlengkapan = mysqli_fetch_assoc($ambilPerlengkapan);
                        $nama_perlengkapan = $fetchPerlengkapan['prlkpn'];
                        $kondisi = $value['kondisi'];
                        $deskripsi = $value ['perlengkapan'];
                        ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$nama_perlengkapan?></td>
                          <td><?=$kondisi?></td>
                          <td><?=$deskripsi?></td>
                          <td>
                            <form action="modules/mobil/proses.php?act=deleteList" method="post">
                              <input type="hidden" name="indeks" value=<?=$key?>>
                              <button type="submit" name="deleteList"class="btn btn-danger btn-sm" ><i class = "far fa-trash-alt"></i></button>
                            </form>
                          </td>
                      </tr>
                      <?php
                      $i++;       
                      }
                    }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col">
                  
                    <form action="modules/mobil/proses.php?act=insertMobil" method="post">
                      <button type="submit" name="insertMobil" class="btn btn-success float-right">Submit</button>
                    </form>
                    
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <?php 
  } 
?>