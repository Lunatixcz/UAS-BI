<?php
if (isset($_GET['id_pembelian'])) { ?>
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pembelian</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
  $id_pembelian = $_GET['id_pembelian'];
  $execQuery = mysqli_query($conn, "SELECT pembelian.jatuh_tempo, pembelian.no_faktur, supplier.nama
                                    FROM pembelian
                                    JOIN supplier ON pembelian.id_supplier = supplier.id_supplier
                                    WHERE pembelian.id_pembelian = '$id_pembelian'");
  while ($data = mysqli_fetch_array($execQuery)){
    $no_faktur = $data ['no_faktur'];
    $supplier = $data ['nama'];
    $jatuh_tempo = $data ['jatuh_tempo'];
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
              <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                      <label>No. Faktur</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$no_faktur?>' class="form-control" readonly>
                      <br>
                      <label>Supplier</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$supplier?>' class="form-control" readonly>
                      <br>
                      <label>Jatuh Tempo</label>
                      <input type="date" id="jatuh_tempo" value="<?=$jatuh_tempo?>" name="jatuh_tempo" placeholder="jatuhtempo" class="form-control" readonly>
                    </div>
                  </div>
                  <br>
      <?php
        }
      ?>        
<!-- form tutup -->
                <br>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <h3>List Barang :</h3>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Harga Barang</th>
                      <th>Bruto</th>
                      <th>Disc</th>
                      <th>Netto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        $execQuery = mysqli_query($conn, "SELECT p.id_pembelian, hp.*,  b.nama_barang 
                                                          FROM pembelian p
                                                          JOIN history_pembelian hp ON p.id_pembelian = hp.id_pembelian 
                                                          JOIN barang b ON hp.id_barang = b.id_barang 
                                                          WHERE p.id_pembelian = '$id_pembelian';");
                        while ($data = mysqli_fetch_array($execQuery)){
                          $nama_barang = $data ['nama_barang'];
                          $kuantitas  = $data ['kuantitas'];
                          $harga_barang = number_format($data ['harga_barang'], 0, ',', '.');
                          $disc = number_format($data ['disc'], 0, ',', '.');
                          $bruto = number_format($data ['bruto'], 0, ',', '.');
                          $netto = number_format($data ['netto'], 0, ',', '.');
                    ?>
                    <tr>
                        <td><?=$i?></>
                        <td><?=$nama_barang?></td>
                        <td><?=$kuantitas?></td>
                        <td>Rp. <?=$harga_barang?></td>
                        <td>Rp. <?=$bruto?></td>
                        <td><?=$disc?>%</td>
                        <td>Rp. <?=$netto?></td>
                    </tr>
                    <?php
                    $i++;
                      }
                    ?>
                    </tbody>
                  </table>
                  <div class="row justify-content-end">
                    <div class="col-1">
                      <a href="?module="></a><button type="button" class="btn btn-primary">Edit</button>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <br>
              <br>
              <br>
              <br>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-3">
                <style>
                .row-spacing{
                  padding-top: 100px;
                }
              </style>
              <table class="table-bordered w-100">
                    <thead>
                      <tr>
                        <th colspan="2"  class="text-center"><h4>Tanda Tangan</h4></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="row-spacing-bottom">Tanggal :</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;Dibukukan Oleh&#41;</td>
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;Disetujui Oleh&#41;</td>
                        
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;Dikirim Oleh&#41;</td>
                        
                      </tr>
                      <tr>
                        <td class="text-center row-spacing">&#40;Diterima Oleh&#41;</td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-3"></div>
                <div class="col-6">
                <?php
                    $execQuery = mysqli_query($conn, "SELECT p.jatuh_tempo
                                                      FROM pembelian p
                                                      WHERE p.id_pembelian = '$id_pembelian'");
                    while ($data = mysqli_fetch_array($execQuery)){
                      $jatuh_tempo = $data ['jatuh_tempo'];
                  ?>
                  <p class="lead">Jatuh Tempo : <?=$jatuh_tempo?></p>
                  <?php
                    }
                  ?>
                  <div class="table-responsive">
                    <table class="table">
                    <?php
                        $i = 1;
                        $execQuery = mysqli_query($conn, "SELECT p.id_pembelian, SUM(hp.bruto) as total_bruto, SUM(hp.netto) as total_netto, SUM(hp.diskon) as total_diskon
                                                          FROM pembelian p 
                                                          JOIN history_pembelian hp ON p.id_pembelian = hp.id_pembelian 
                                                          WHERE p.id_pembelian = '$id_pembelian' 
                                                          GROUP BY p.id_pembelian;");

                        while ($data = mysqli_fetch_array($execQuery)){
                          $totBruto =  number_format($data ['total_bruto'], 0, ',', '.');
                          $totDiskon =  number_format($data ['total_diskon'], 0, ',', '.');
                          $totNetto  = number_format($data ['total_netto'], 0, ',', '.');
                    ?>
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. <?=$totBruto?></td>
                      </tr>
                      <tr>
                        <th>Disc</th>
                        <td>Rp. <?=$totDiskon?></td>
                      </tr>
                      <tr>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>Rp. <?=$totNetto?></td>
                      </tr>
                      <?php
                        }
                      ?>
                    </table>
                  </div>
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
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
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
            <h1>Tambah Pembelian</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




 <!--Penambahan-->   
 <!-- generate nomor Faktur -->   
<?php
  $totBruto = 0;
  $totDiskon = 0;
  $totNetto = 0;
  $jatuh_tempo_bawah = "DD/MM/YYYY";
  $query = "SELECT MAX(nomor_transaksi) as last_transaksi , no_faktur from pembelian;";
  $execQuery = mysqli_query($conn, $query);
  $fetchQuery = mysqli_fetch_array($execQuery);
  $date = date('ym');
  $current_month = date('m');
  $stored_month = substr($fetchQuery['no_faktur'], 5, 2); // extract the stored month from the last ID
  $next_number = 1; // Set a default value for next_number before the if-else block
  if ($current_month == $stored_month) {
      // Increment the next number by 1 if the current month is the same as the stored month
      $next_number = (int)$fetchQuery['last_transaksi'] + 1;
  }
  $date = date('ym');
  $newFaktur = 'PB/' . $date .'/'. str_pad($next_number, 4, '0', STR_PAD_LEFT);
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
              <div class="row">
                
                  <?php
                  if (!isset($_SESSION['temp_transaksi_beli'])) {/* pengulangan pertama */
                  ?>
                  <div class="col-sm-4 invoice-info">
                    <form action="modules/transaksi/pembelian/proses.php?act=inserttemp" method="post"> <!-- form buka -->
                      <input type="hidden" name="nomor_transaksi" placeholder="You Shouldn't See This" value='<?= $next_number?>' class="form-control" hidden>
                      <label>No. Faktur</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?= $newFaktur?>' class="form-control" readonly>
                      <br>
                      <label>Supplier</label>
                      <select name="id_supplier" class="form-control">
                          <?php
                            $pilihansupplier = mysqli_query($conn, "select * from supplier WHERE status = 'Y'");
                            while ($fetcharray = mysqli_fetch_array($pilihansupplier)) {
                            $namasupplier = $fetcharray['nama'];
                            $idsup = $fetcharray['id_supplier'];
                            ?>
                            <option value="<?= $idsup; ?>">
                                <?= $namasupplier; ?>
                            </option>
                            <?php
                            }
                          ?>
                      </select>
                      <br>
                      <label>Jatuh Tempo</label>
                      <input type="date" id="jatuh_tempo" name="jatuh_tempo" placeholder="jatuhtempo" class="form-control" required>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5" style="margin-left : 24px; ">
                      <div class="row">
                        <h5><b>History Pembelian Terdahulu</b></h5>
                      </div>
                      <div class="row" style="margin-top : 24px">
                      <div class="col-12">
                
                        <table id='example2' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>No Faktur</th>
                                    <th>Stok Sekarang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                            
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin : 24px 0 0 2px">
                      <button type="button" name="reset" class="btn btn-secondary align-items-center" onclick="window.location.href='modules/transaksi/pembelian/proses.php?act=reset'" style="height : 50px" disabled>Reset</button>
                  </div>
                  <br>
                  <?php
                  } else { 
                    $no_transaksi = $_SESSION['temp_transaksi_beli']['no_transaksi'];
                    $supplier = $_SESSION['temp_transaksi_beli']['id_supplier'];
                    $jatuh_tempo = $_SESSION['temp_transaksi_beli']['jatuh_tempo'];
                    $barang_array = $_SESSION['temp_data_beli'];
                    // Get the latest index of the temp_data_beli array
                    $nama_barang = "Nama Barang";
                    $total_kuantitas = "";
                    $harga_barang = "0";
                    $no_faktur = "PB/XXXX/XXXX";
                    $tanggal = "";
                    $kuantitas = "0";

                  
                  ?>
                  <div class="col-sm-4 invoice-col">
                  <form action="modules/transaksi/pembelian/proses.php?act=inserttemp" method="post"> 
                    <!-- form buka -->
                      <input type="hidden" name="nomor_transaksi" placeholder="You Shouldn't See This" value='<?= $next_number?>' class="form-control" hidden>
                      <label>No. Faktur</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$newFaktur?>' class="form-control" readonly>
                      <br>
                      <label>Supplier</label>
                      <select name="id_supplier" class="form-control" style="pointer-events: none; background-color: #e9ecef;">
                        <?php
                        $pilihansupplier = mysqli_query($conn, "select * from supplier WHERE status = 'Y'");
                        while ($fetcharray = mysqli_fetch_array($pilihansupplier)) {
                          $namasupplier = $fetcharray['nama'];
                          $idsup = $fetcharray['id_supplier'];
                          $selected = ($idsup == $supplier) ? "selected" : "";
                          ?>
                          <option value="<?= $idsup; ?>" <?= $selected ?>>
                            <?= $namasupplier; ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      <br>
                      <label>Jatuh Tempo</label>
                      <input type="date" id="jatuh_tempo" value="<?=$jatuh_tempo?>" name="jatuh_tempo" placeholder="jatuhtempo" class="form-control" readonly>
                    </div>
                    <div class="col-sm-2 invoice-col d-md-flex justify-content-md-end">
                  </div>
                  <!-- History Pembelian Terdahulu -->
                  <div class="col-sm-5" style="margin-left : 24px;">
                      <div class="row">
                        <h5><b>History Pembelian Terdahulu</b></h5>
                      </div>
                      <div class="row" style="margin-top : 24px">
                      <div class="col-12">
                      <?php
                            if (isset($_GET['id_barang'])) {
                                $id_barang = $_GET['id_barang'];
                                $query = "SELECT hp.*, b.nama_barang, p.no_faktur, s.nama as nama_supplier, p.tanggal
                                FROM history_pembelian hp
                                JOIN barang b ON hp.id_barang = b.id_barang
                                JOIN pembelian p ON hp.id_pembelian = p.id_pembelian
                                JOIN supplier s ON hp.id_supplier = s.id_supplier
                                WHERE b.id_barang = $id_barang";
                                $execQuery = mysqli_query($conn, $query);
                            ?>
                                <table id='example2' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>No Faktur</th>
                                            <th>Supplier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
                                  while ($row = mysqli_fetch_array($execQuery)) {
                                    // Access the values using the column names
                                    $nama_barang = $row['nama_barang'];
                                    $kuantitas = $row['kuantitas'];
                                    $netto = number_format($row['netto'], 0, ',', '.');
                                    $tanggal = $row['tanggal'];
                                    $no_faktur = $row['no_faktur'];
                                    $supplier = $row['nama_supplier'];
                            ?>
                                        <tr>
                                            <td><?= $nama_barang ?></td>
                                            <td><?= $kuantitas ?></td>
                                            <td>Rp. <?= $netto ?></td>
                                            <td><?= $no_faktur ?></td>
                                            <td><?= $supplier ?></td>
                                        </tr>
                            <?php
                                }
                            ?>
                                    </tbody>
                                </table>
                          <?php
                          }else {?>
                            <table id='example2' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>No Faktur</th>
                                    <th>Stok Sekarang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                          <?php
                          }
                          ?>
                        </div>
                        </div>
                        
                      
                    </div>
                  </div>
                  <div class="row" style="margin: 24px 0 0 2px">
                      <button type="button" name="reset" class="btn btn-primary align-items-center" onclick="window.location.href='modules/transaksi/pembelian/proses.php?act=reset'" style="height : 50px">Reset</button>
                    </div>
                  <br>
                  <?php
                  }
                  ?>
                
              <!-- /.row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" id="tableBarang">
                  <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Qty</th>
                      <th>Harga Barang</th>
                      <th>Disc</th>
                      <th>Submit</th>
                    </tr>
                    </thead>
                    <tbody>
                      
                    <tr>
                    <td>
  <select name="id_barang" class="form-control" onchange="updateUOMpembelian(this.value)">
  <option value="">Select an item</option>
    <?php
    $pilihanbarang = mysqli_query($conn, "select * from barang WHERE status = 'Y'");
    while ($fetcharray = mysqli_fetch_array($pilihanbarang)) {
      $namabarang = $fetcharray['nama_barang'];
      $barang_id = $fetcharray['id_barang']; // use a different variable name here
    ?>
      <option value="<?= $barang_id; ?>">
        <?= $namabarang; ?>
      </option>
    <?php
    }
    ?>
  </select>
</td>
<td>
  <select name="uom" class="form-control" id="uom_select">
  </select>
  <input type="text" class="form-control" name="satuan_kecil" id="satuankecil_input" hidden>
</td>
  <td>
  <input type="text" class="form-control kuantitaspembelian_mask" name="kuantitas" oninput="formatNumber('kuantitaspembelian_mask')" required>
  </td>
      <td>
      <div class="input-group mb-3">
        <div class="input-group-append">
        </div>
        <input type="text" class="form-control hargapembelian_mask" name="harga_barang" oninput="formatCurrency('hargapembelian_mask')" required>
      </div>
      </td>
      <td>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="disc" id="discpembelian_mask" oninput="formatNumber('discpembelian_mask')" required>
        <div class="input-group-append">
          <span class="input-group-text">%</span>
        </div>
      </div>
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
                  <h3>List Barang :</h3>
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Harga Barang</th>
                      <th>Bruto</th>
                      <th>Disc</th>
                      <th>Netto</th>
                      <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!isset($_SESSION['temp_data_beli'])) {
                      ?>
                      <tr>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                      </tr>
                      <?php
                    } else {
                      $i = 1;
                      foreach ($_SESSION['temp_data_beli'] as $key => $value){   
                        $id_barang = $value['id_barang'];
                        $id_supplier = $value['id_supplier'];
                        $query = "SELECT nama_barang FROM barang WHERE $id_barang = id_barang";
                        $ambilBarang= mysqli_query($conn, $query);
                        $fetchBarang = mysqli_fetch_assoc($ambilBarang);
                        $nama_barang = $fetchBarang['nama_barang'];
                        $kuantitas = $value['kuantitas'];
                        $harga_barang = $value ['harga_barang'];
                        $harga_barang_formatted = number_format($harga_barang, 0, ',', '.');
                        $bruto = $value ['bruto'];
                        $bruto_formatted = number_format($bruto, 0, ',', '.');
                        $disc = $value ['disc'];
                        $netto = $value ['netto'];
                        $netto_formatted = number_format($netto, 0, ',', '.');
                        $diskon = $value ['diskon'];
                        ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><a href="main.php?module=detailPembelian&id_barang=<?=$id_barang?>" style="text-decoration: none; color : black;"><?=$nama_barang?></a></td>
                          <td><?=$kuantitas?></td>
                          <td>Rp. <?=$harga_barang_formatted?></td>
                          <td>Rp. <?=$bruto_formatted?></td>
                          <td><?=$disc?>%</td>
                          <td>Rp. <?=$netto_formatted?></td>
                          <td>
                            <form action="modules/transaksi/pembelian/proses.php?act=deleteList" method="post">
                              <input type="hidden" name="indeks" value=<?=$key?>>
                              <button type="submit" name="deleteList"class="btn btn-danger btn-sm" ><i class = "far fa-trash-alt"></i></button>
                            </form>
                          </td>
                      </tr>
                      <?php
                      $i++;

                      $totBruto += $bruto;
                      $totDiskon += $diskon;
                      $totNetto += $netto;
                      $_SESSION['totNetto'] = $totNetto;
                      }
                      $totBruto = number_format($totBruto, 0, ',', '.');
                      $totDiskon = number_format($totDiskon, 0, ',', '.');
                      $totNetto = number_format($totNetto, 0, ',', '.');
                      
                      $jatuh_tempo_bawah = $jatuh_tempo;
                    }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Jatuh Tempo : <?=$jatuh_tempo_bawah?></p>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. <?=$totBruto?></td>
                      </tr>
                      <tr>
                        <th>Disc</th>
                        <td>Rp. <?=$totDiskon?></td>
                      </tr>
                      <tr>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>Rp. <?=$totNetto?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col">
                    <form action="modules/transaksi/pembelian/proses.php?act=insertPembelian" method="post">
                      <button type="submit" name="insertPembelian" class="btn btn-success float-right">Submit</button>
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