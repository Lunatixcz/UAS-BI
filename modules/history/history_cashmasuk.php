<?php
if (isset($_GET['id_mas'])) { ?>
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Cash Masuk</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
  $id_mas = $_GET['id_mas'];

  $execQuerysumber = mysqli_query($conn, "SELECT sumber FROM `cash_masuk` WHERE id_cmasuk = '$id_mas'");
  $data = mysqli_fetch_array($execQuerysumber);
  $sumber = $data['sumber'];
  if(is_numeric($sumber)) {
    $execQuerynum = mysqli_query($conn, "SELECT cm.bukti_masuk, cm.terima_dari, cm.tanggal_masuk, cm.keterangan, cm.jumlah, c.nama as nama_customer
    FROM cash_masuk AS cm
    JOIN customer AS c ON cm.sumber = c.id_customer
    WHERE id_cmasuk = $id_mas;
    ");
  while ($data = mysqli_fetch_array($execQuerynum)){
    $bukti_masuk = $data ['bukti_masuk'];
    $terima_dari = $data ['terima_dari'];
    $tanggal_masuk = $data ['tanggal_masuk'];
    $keterangan = $data ['keterangan'];
    $nama_customer = $data ['nama_customer'];
  }
}
else {
    $execQuerynotnum = mysqli_query($conn, "SELECT cm.bukti_masuk, cm.terima_dari, cm.tanggal_masuk, cm.keterangan, cm.jumlah, cm.sumber AS nama_customer
    FROM cash_masuk AS cm
    WHERE id_cmasuk = '$id_mas';
    ");
  while ($data = mysqli_fetch_array($execQuerynotnum)){
    $bukti_masuk = $data ['bukti_masuk'];
    $terima_dari = $data ['terima_dari'];
    $tanggal_masuk = $data ['tanggal_masuk'];
    $keterangan = $data ['keterangan'];
    $jumlah = number_format($data ['jumlah'], 0, ',', '.');
    $nama_customer = $data ['nama_customer'];
  }
}
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
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$bukti_masuk?>' class="form-control" readonly>
                      <br>
                      <label>Diterima Dari</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$nama_customer?>(<?= $terima_dari ?>)' class="form-control" readonly>
                      <br>        
                    </div>
                    <div class="col-sm-2 invoice-col">

                    </div>
                    <div class="col-sm-4 invoice-col">
                    <label>Keterangan</label>
                      <input type="text" name="no_faktur" placeholder="Tidak ada keterangan" value='<?=$keterangan?>' class="form-control" readonly>
                      <br>
                      <label>Tanggal Masuk</label>
                      <input type="date" id="jatuh_tempo" value="<?=$tanggal_masuk?>" name="jatuh_tempo" placeholder="jatuhtempo" class="form-control" readonly>
                      <br>       
                    </div> 
                  </div>
                  <br>        
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
                      <th>Account</th>
                      <th>Nama Akun</th>
                      <th>Barang</th>
                      <th>Qty</th>
                      <th>Jasa</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $execQuerylist = mysqli_query($conn, "SELECT hcm.jumlah, a.kode_akun, a.nama_akun, hcm.kuantitas,
                      CASE
                        WHEN hcm.id_barang = 0 THEN ''
                          ELSE b.nama_barang
                          END AS nama_barang,
                      CASE
                        WHEN hcm.jasa = 0 THEN ''
                          ELSE j.nama_jasa
                          END AS nama_jasa
                      FROM cash_masuk AS cm
                      JOIN akun AS a ON cm.id_akun = a.id_akun
                      JOIN history_cash_masuk AS hcm ON cm.id_cmasuk = hcm.id_cash_masuk
                      LEFT JOIN barang AS b ON hcm.id_barang = b.id_barang
                      LEFT JOIN jasa AS j ON hcm.jasa = j.id_jasa
                      WHERE id_cmasuk = $id_mas;");

                        $i = 0;
                        while ($data = mysqli_fetch_array($execQuerylist)) {
                          $i++;                          
                          $kode_akun = $data['kode_akun'];
                          $nama_akun = $data['nama_akun'];
                          $nama_barang = $data['nama_barang'];
                          $kuantitas = $data['kuantitas'];
                          $nama_jasa = $data['nama_jasa'];
                          $jumlah = number_format($data['jumlah'], 0, ',', '.');
                      ?>
                      <tr>
                        <td><?= $i?></td>
                        <td><?= $kode_akun?></td>
                        <td><?= $nama_akun?></td>
                        <td><?= $nama_barang?></td>
                        <td><?= $kuantitas?></td>
                        <td><?= $nama_jasa?></td>
                        <td>Rp. <?= $jumlah?></td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
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
                </div>
    </section>
    <?php 
  } 
?>