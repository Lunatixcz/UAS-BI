<section class="content-header">
      <div class="container-fluid">
      <?php
      $id_akun = $_GET['id_akun'];

        if (isset($_GET['alert'])) {
          $alert =  $_GET['alert'];
          switchAlert($alert);
          }
      ?>
        <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>History Akun</h1>
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
                      
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Akun</th>
                    <th>No. Faktur</th>
                    <th>Kredit</th>
                    <th>Debit</th>
                    <th>Tanggal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $queryHistoryAkun = " SELECT
                      history_akun.*,
                      pembelian.no_faktur AS pembelian_no_faktur,
                      penjualan.no_faktur AS penjualan_no_faktur,
                      cash_keluar.bukti_keluar AS keluar_no_faktur,
                      cash_masuk.bukti_masuk AS masuk_no_faktur,
                      akun.nama_akun
                    FROM
                      history_akun
                    LEFT JOIN
                      pembelian ON history_akun.id_pembelian = pembelian.id_pembelian
                    LEFT JOIN
                      penjualan ON history_akun.id_penjualan = penjualan.id_penjualan
                    LEFT JOIN
                      akun ON history_akun.id_akun = akun.id_akun
                    LEFT JOIN
                      cash_keluar ON history_akun.id_ckeluar = cash_keluar.id_ckeluar
                    LEFT JOIN
                      cash_masuk ON history_akun.id_cmasuk = cash_masuk.id_cmasuk
                    WHERE
                      history_akun.id_akun = $id_akun";
                    

                    $execHistoryAkun = mysqli_query($conn, $queryHistoryAkun);

                    while($data = mysqli_fetch_array($execHistoryAkun)){
                        $no_faktur = '';
                        if (!empty($data['pembelian_no_faktur'])) {
                          $no_faktur = $data['pembelian_no_faktur'];
                        } elseif (!empty($data['penjualan_no_faktur'])) {
                          $no_faktur = $data['penjualan_no_faktur'];
                        } elseif (!empty($data['keluar_no_faktur'])){
                          $no_faktur = $data['keluar_no_faktur'];
                        } else {
                          $no_faktur = $data['masuk_no_faktur'];
                        }
                        $nama_akun = $data['nama_akun'];
                        $tanggal = $data['tanggal'];
                        $kredit = number_format($data['kredit'], 0); // Format 'kredit' with 2 decimal places
                        $debit = number_format($data['debit'], 0); // Format 'debit' with 2 decimal places
                     ?>
                     <tr>
                        <td><?=$nama_akun?></td>
                        <td><?=$no_faktur?></td>
                        <td>Rp. <?=$kredit?></td>
                        <td>Rp. <?=$debit?></td>
                        <td><?=$tanggal?></td>
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