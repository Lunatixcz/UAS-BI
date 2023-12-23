<?php
if (isset($_GET['id_kel'])) { ?>
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Cash Keluar</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php
  $id_kel = $_GET['id_kel'];

  $execQuerysumber = mysqli_query($conn, "SELECT terima_dari FROM cash_keluar WHERE id_ckeluar = $id_kel");
  $data = mysqli_fetch_array($execQuerysumber);
  $terima_dari = $data['terima_dari'];

  if($terima_dari == 'customer') {
    $execQuerycus = mysqli_query($conn, "SELECT ck.bukti_keluar, ck.jumlah, ck.tanggal_keluar, ck.keterangan, c.nama AS dibayarkan_kepada
    FROM cash_keluar AS ck
    JOIN customer AS c ON ck.dari = c.id_customer
    WHERE id_ckeluar = $id_kel
    ");
  while ($data = mysqli_fetch_array($execQuerycus)){
    $bukti_keluar = $data ['bukti_keluar'];
    $tanggal_keluar = $data ['tanggal_keluar'];
    $keterangan = $data ['keterangan'];
    $dibayarkan_kepada = $data ['dibayarkan_kepada'];
  }
}
else if($terima_dari == 'pihak_jasa'){
    $execQueryjas = mysqli_query($conn, "SELECT ck.bukti_keluar, ck.terima_dari, ck.keterangan, ck.tanggal_keluar, pj.nama_pihak AS dibayarkan_kepada
    FROM cash_keluar AS ck
    JOIN pihak_jasa AS pj ON ck.dari = pj.id_pjasa
    WHERE id_ckeluar = $id_kel;
    ");
  while ($data = mysqli_fetch_array($execQueryjas)){
    $bukti_keluar = $data ['bukti_keluar'];
    $terima_dari = 'pihak jasa';
    $tanggal_keluar = $data ['tanggal_keluar'];
    $keterangan = $data ['keterangan'];
    $dibayarkan_kepada = $data ['dibayarkan_kepada'];
  }
}
else {
    $execQuerylain = mysqli_query($conn, "SELECT ck.bukti_keluar, ck.terima_dari, ck.keterangan, ck.tanggal_keluar, ck.dari AS dibayarkan_kepada
    FROM cash_keluar AS ck
    WHERE ck.id_ckeluar = $id_kel;
    ");
  while ($data = mysqli_fetch_array($execQuerylain)){
    $bukti_keluar = $data ['bukti_keluar'];
    $terima_dari = $data ['terima_dari'];
    $tanggal_keluar = $data ['tanggal_keluar'];
    $keterangan = $data ['keterangan'];
    $dibayarkan_kepada = $data ['dibayarkan_kepada'];
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
                      <label>No. Bukti</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$bukti_keluar?>' class="form-control" readonly>
                      <br>
                      <label>Dibayarkan Kepada</label>
                      <input type="text" name="no_faktur" placeholder="No Faktur" value='<?=$dibayarkan_kepada?>(<?= $terima_dari ?>)' class="form-control" readonly>
                      <br>        
                    </div>
                    <div class="col-sm-2 invoice-col">

                    </div>
                    <div class="col-sm-4 invoice-col">
                    <label>Keterangan</label>
                      <input type="text" name="no_faktur" placeholder="Tidak ada keterangan" value='<?=$keterangan?>' class="form-control" readonly>
                      <br>
                      <label>Tanggal Keluar</label>
                      <input type="date" id="jatuh_tempo" value="<?=$tanggal_keluar?>" name="jatuh_tempo" placeholder="jatuhtempo" class="form-control" readonly>
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
                      <th>Kuantitas</th>
                      <th>Jasa</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $execQuerylist = mysqli_query($conn, "SELECT hck.jumlah, a.kode_akun, a.nama_akun, hck.kuantitas,
                      CASE
                        WHEN hck.id_barang = 0 THEN ''
                          ELSE b.nama_barang
                          END AS nama_barang,
                      CASE
                        WHEN hck.id_jasa = 0 THEN ''
                          ELSE j.nama_jasa
                          END AS nama_jasa
                      FROM cash_keluar AS ck
                      JOIN akun AS a ON ck.id_akun = a.id_akun
                      JOIN history_cash_keluar AS hck ON ck.id_ckeluar = hck.id_cash_keluar
                      LEFT JOIN barang AS b ON hck.id_barang = b.id_barang
                      LEFT JOIN jasa AS j ON hck.id_jasa = j.id_jasa
                      WHERE id_ckeluar = $id_kel;");

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