<section class="content-header">
    <div class="container-fluid">
    <?php
        if (isset($_GET['alert'])) {
            $alert =  $_GET['alert'];
            switchAlert($alert);
    }
    // if (isset($_GET['alert'])) {
    //     $alert =  $_GET['alert'];
    //     switchAlert($alert);
// }
?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pembelian</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-md-end">
                        <a href="main.php?module=detailPembelian">
                            <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-plus-square"></i> Tambah Pembelian
                            </button>
                        </a>
                    </div>
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>No. Faktur </th>
                                <th>Tanggal Pembelian</th>
                                <th>Supplier</th>
                                <th>Netto</th>
                                <th>Status</th>
                                <th>Jatuh Tempo</th>
                                <th>Action</th>
                                <th>Check Box</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT p.*, s.nama
                                            FROM pembelian p
                                            INNER JOIN supplier s ON p.id_supplier = s.id_supplier
                                            ";
                                $execQuery = mysqli_query($conn, $query);

                                while ($data = mysqli_fetch_array($execQuery)){
                                    $id_pembelian = $data ['id_pembelian'];
                                    $no_faktur = $data ['no_faktur'];
                                    $tanggal  = $data ['tanggal'];
                                    $jatuh_tempo  = $data ['jatuh_tempo'];
                                    $supplier = $data ['nama'];
                                    $netto = $data ['netto'];
                                    $nettoformat = number_format($data['netto'], 0, ',', '.');
                                    $status = $data ['status_pembayaran'];
                                ?>
                                <tr>
                                    <td><?=$no_faktur?></td>
                                    <td><?=$tanggal?></td>
                                    <td><?=$supplier?></td>
                                    <td>Rp. <?=$nettoformat?></td>
                                    <td>
                                        <?php
                                        if ($status == "N") {
                                            echo "Belum Terbayar";
                                        } else {
                                            echo "Terbayar";
                                        }
                                        ?>
                                    </td>
                                    <td><?=$jatuh_tempo?></td>
                                    <td>
                                        <a href="?module=detailPembelian&id_pembelian=<?=$id_pembelian?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a>
                                        <?php
                                        if ($status == "N") {
                                            // echo"<a href='".$id_pembelian."'>";
                                            echo "<button type='button' class='btn btn-danger btn-sm' disabled><i class='fas fa-times' style='color: #ffffff'></i></button>";
                                        } else {
                                            echo "<button type='button' class='btn btn-success btn-sm' disabled><i class='fas fa-check' style = 'color : #ffffff'></i></button>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                        if ($status == "N") { ?>
                                        <input type="checkbox" name="nobayar[]" value="<?=$netto?>" data-id_pembelian="<?=$id_pembelian?>" data-no_faktur="<?=$no_faktur?>" class="netto-checkbox">
                                        <?php } else {?>
                                            <input type="checkbox" name="nobayar[]" value="<?=$netto?>" data-id_pembelian="<?=$id_pembelian?>" data-no_faktur="<?=$no_faktur?>" class="netto-checkbox" disabled>
                                        <?php    
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                </table>
                        <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#bayar'>Bayar</button>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>
                <br><br>
                <div class="row">
                    <div class="col-8"></div>
                    <?php
                        $query = "SELECT SUM(netto) as utang_dagang FROM pembelian WHERE status_pembayaran = 'N'";
                        $execQuery = mysqli_query($conn, $query);

                        $query2 = "SELECT SUM(netto) as utang_bayar FROM pembelian WHERE status_pembayaran = 'Y'";
                        $execQuery2 = mysqli_query($conn, $query2);

                        $ambilUtangDagang = mysqli_fetch_array($execQuery);
                        $utang_dagang =  number_format($ambilUtangDagang['utang_dagang'], 0, ',', '.');

                        $ambilUtangbayar = mysqli_fetch_array($execQuery2);
                        $utang_bayar =  number_format($ambilUtangbayar['utang_bayar'], 0, ',', '.');
                    ?>
                    <div class="col-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Utang Dagang :</th>
                                    <td>Rp. <?=$utang_dagang?></td>
                                </tr>
                                <tr>
                                    <th>Utang Dibayar :</th>
                                    <td>Rp. <?=$utang_bayar?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
<?php
if (isset($_GET['netto'])) {
    $nettoatas = isset($_GET['netto']) ? $_GET['netto'] : 0; // Assign a default value of 0 if netto is not set
    $formattedNetto = number_format($nettoatas, 0, ',', '.');

// Use the $formattedNetto variable wherever you need the formatted netto value

    // Lakukan sesuatu dengan nilai netto yang diterima
  } else {
    // Lakukan sesuatu jika netto tidak ada
    // (misalnya, mengatur nilai default atau menampilkan pesan kesalahan)
    $nettoatas = 0; // Nilai default jika netto tidak ada
    $formattedNetto = number_format($nettoatas, 0, ',', '.');
    // atau
    echo "Netto tidak ditemukan!";
  }

if (isset($_GET['id_pembelian'])) {
$id_pembelian = $_GET['id_pembelian'];
$id_pembelian_array = explode(',', $id_pembelian);
} else {
// Handle the case when id_pembelian is not set
// (set default value or display an error message)
$id_pembelian_array = array(); // Empty array as default value
} 
?>

<!-- The Modal -->
<?php
    $query2 = "SELECT id_pembelian , no_faktur , netto FROM pembelian";
    $execQuery2 = mysqli_query($conn, $query2);

    while ($data2 = mysqli_fetch_array($execQuery2)){
    $id_pembelian = $data2 ['id_pembelian'];
    $no_faktur = $data2 ['no_faktur'];
    // $netto = $data2 ['netto'];
    // $formattedNetto = number_format($netto, 0, ',', '.');
    ?>
  <div class="modal fade" id="bayar">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">     
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pembelian</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form action="modules/transaksi/pembelian/proses.php?act=buy" method="post">
                <p>Selesaikan Pembayaran?</p>
                <input name="id_pembelian"  id="id_pembelian" hidden>
                <textarea id="noFakturDisplay" class="form-control" rows="3" readonly></textarea>
                <br>
                <input name="jumlah" class="form-control" id="totalNetto" readonly>
                <br>
                <select name="id_akun" class="form-control">
                <?php
                $query = "SELECT * FROM akun";
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
                <br>
                <br>
                <button type="button" class="btn btn-danger" style="float: left;" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="buy" style="float: right;">Submit</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
  <?php
    }mysqli_close($conn);
?>