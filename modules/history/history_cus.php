<section class="content-header">
      <div class="container-fluid">
      <?php
      $id_cus = $_GET['id_cus'];

        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }

          $queryCus = "SELECT * FROM customer WHERE id_customer = '$id_cus'";
          $execQuery = mysqli_query($conn, $queryCus);
          $data = mysqli_fetch_array($execQuery);
          $nama = $data['nama'];



      ?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>History Customer <?= $nama;?></h1>
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
                    <th>Nomor Faktur</th>
                    <th>Jatuh Tempo</th>
                    <th>Netto</th>
                    <th>Plat</th>
                    <th>Status Pembayaran</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = "SELECT * FROM penjualan WHERE id_customer = '$id_cus'";
                    $execQuery = mysqli_query($conn, $query);

                    while($data = mysqli_fetch_array($execQuery)){
                        $id_penjualan = $data['id_penjualan'];
                        $plat = $data['plat'];
                        $nomor_faktur = $data['no_faktur'];
                        $jatuh_tempo = $data['jatuh_tempo'];
                        $nettoformat = number_format($data['netto'], 0, ',', '.');
                        $status_pembayaran = $data['status_pembayaran'];
                     ?>
                     <tr>
                        <td><?=$nomor_faktur?></td>
                        <td><?=$jatuh_tempo?></td>
                        <td>Rp. <?=$nettoformat?></td>
                        <td><?=$plat?></td>
                        <td><?=$status_pembayaran?></td>
                        <td>
                        <a href="?module=detailPenjualan&id_penjualan=<?=$id_penjualan?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a>
                        </td>
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