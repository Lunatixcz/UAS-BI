<section class="content-header">
      <div class="container-fluid">
      <?php
      $id_barang = $_GET['id_barang'];

        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }
      ?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>History Pembelian</h1>
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
            <div class="card-header">
                <div class = "row">
                    <div class="col-4">
                      <a href="?module=historyPenjualan&id_barang=<?=$id_barang?>" class = "btn btn-outline-danger">Penjualan</a>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Kuantitas</th>
                    <th>Netto</th>
                    <th>Tanggal</th>
                    <th>No.Faktur</th>
                    <th>Supplier</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = "SELECT hp.*, b.nama_barang, p.no_faktur, s.nama as nama_supplier, p.tanggal
                                FROM history_pembelian hp
                                JOIN barang b ON hp.id_barang = b.id_barang
                                JOIN pembelian p ON hp.id_pembelian = p.id_pembelian
                                JOIN supplier s ON hp.id_supplier = s.id_supplier
                                WHERE b.id_barang = $id_barang";
                    $execQuery = mysqli_query($conn, $query);

                    while($data = mysqli_fetch_array($execQuery)){
                        $nama_barang = $data['nama_barang'];
                        $kuantitas = $data['kuantitas'];
                        $netto = number_format($data ['netto'], 0, ',', '.');
                        $tanggal = $data['tanggal'];
                        $no_faktur = $data['no_faktur'];
                        $supplier = $data['nama_supplier'];
                     ?>
                     <tr>
                        <td><?=$nama_barang?></td>
                        <td><?=$kuantitas?></td>
                        <td>Rp. <?=$netto?></td>
                        <td><?=$tanggal?></td>
                        <td><?=$no_faktur?></td>
                        <td><?=$supplier?></td>
                     </tr>
                     <?php
                    }
                    mysqli_close($conn)
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