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
                <h1>Cash Pemasukan</h1>
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
                        <a href="main.php?module=detailCashMasuk">
                            <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-plus-square"></i> Tambah Pemasukan
                            </button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>No. Bukti</th>
                                <th>Akun</th>
                                <th>Diterima Dari</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM cash_masuk WHERE status_hapus = 'Y';";
                                $execQuery = mysqli_query($conn, $query);

                                while($data = mysqli_fetch_array($execQuery)){
                                    $terima_dari = $data ['terima_dari'];
                                    if ($terima_dari == "customer") {
                                        $sumber = $data['sumber'];
                                        $queryNamaCustomer = "SELECT nama FROM customer WHERE $sumber = id_customer";
                                        $execQueryNamaCustomer = mysqli_query($conn, $queryNamaCustomer);
                                        $fetchNamaCustomer = mysqli_fetch_array($execQueryNamaCustomer);
                                        $nama_customer = $fetchNamaCustomer ['nama'];
                                    } else {
                                        $nama_customer = $data['terima_dari'];
                                    }
                                    $id_cmasuk = $data['id_cmasuk'];
                                    $no_bukti = $data['bukti_masuk'];
                                    $nominal = number_format($data['jumlah'], 0, ',', '.');
                                    $keterangan = $data ['keterangan'];
                                    $id_akun = $data ['id_akun'];
                                    $queryAkun  = "SELECT nama_akun, kode_akun FROM akun WHERE $id_akun = id_akun";
                                    $execQueryAkun = mysqli_query($conn, $queryAkun);
                                    $fetchAkun = mysqli_fetch_array($execQueryAkun);
                                    $nama_akun = $fetchAkun['nama_akun'];
                                ?>
                                <tr>
                                    <td><?=$no_bukti?></td>
                                    <td><?=$nama_akun?></td>
                                    <td><?=$nama_customer?></td>
                                    <td><?=$nominal?></td>
                                    <td><?=$keterangan?></td>
                                    <td><a href="?module=historyMasuk&id_mas=<?=$id_cmasuk?>"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-ellipsis-h" style="color : #ffffff"></i></button></a></td>
                                </tr>
                                <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>