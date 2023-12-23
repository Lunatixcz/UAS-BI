<section class="content-header">
      <div class="container-fluid">
      <?php
      $id_sup = $_GET['id_sup'];

        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }

          $querySup = "SELECT * FROM supplier WHERE id_supplier = '$id_sup'";
          $execQuery = mysqli_query($conn, $querySup);
          $data = mysqli_fetch_array($execQuery);
          $nama = $data['nama'];



      ?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>History Supplier <?=$nama ?></h1>
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
                    <th>Status Pembayaran</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = "SELECT * FROM pembelian WHERE id_supplier = '$id_sup'";
                    $execQuery = mysqli_query($conn, $query);

                    while($data = mysqli_fetch_array($execQuery)){
                        $id_pembelian = $data['id_pembelian'];
                        $nomor_faktur = $data['no_faktur'];
                        $jatuh_tempo = $data['jatuh_tempo'];
                        $netto = $data['netto'];
                        $status_pembayaran = $data['status_pembayaran'];
                     ?>
                     <tr>
                        <td><?=$nomor_faktur?></td>
                        <td><?=$jatuh_tempo?></td>
                        <td>Rp. <?=$netto?></td>
                        <td><?=$status_pembayaran?></td>
                        <td>
                        <a href="?module=detailPembelian&id_pembelian=<?=$id_pembelian?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a>
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