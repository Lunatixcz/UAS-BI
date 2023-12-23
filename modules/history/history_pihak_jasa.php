<section class="content-header">
    <div class="container-fluid">
        <?php
            $id_pjasa = $_GET['id_pjasa'];

            if (isset($_GET['alert'])) {
                $alert =  $_GET['alert'];
                switchAlert($alert);
                }
        ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>History Jasa</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. Bukti</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Jasa</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $query = "SELECT
                                    ck.id_ckeluar,
                                    ck.keterangan,
                                    ck.tanggal_keluar,
                                    ck.bukti_keluar,
                                    hck.jumlah,
                                    jasa.nama_jasa,
                                    pj.nama_pihak
                                    FROM
                                    cash_keluar AS ck
                                    JOIN history_cash_keluar AS hck ON hck.id_cash_keluar = ck.id_ckeluar
                                    JOIN jasa ON jasa.id_jasa = hck.id_jasa
                                    JOIN pihak_jasa AS pj ON pj.id_pjasa = ck.dari
                                    WHERE
                                    ck.terima_dari = 'pihak_jasa'
                                    AND ck.dari = $id_pjasa";

                                    $execQueryPihak = mysqli_query($conn, $query);
                                    while ($data = mysqli_fetch_array($execQueryPihak)) {
                                        $bukti_keluar = $data['bukti_keluar'];
                                        $nama = $data['nama_pihak'];
                                        $jumlah = $data['jumlah'];
                                        $jumlah = number_format($jumlah,0, ',', '.');
                                        $jasa = $data['nama_jasa'];
                                        $tanggal = $data['tanggal_keluar'];
                                        $keterangan = $data['keterangan']
                                    ?>
                                    <tr>
                                        <td><?=$bukti_keluar?></td>
                                        <td><?=$nama?></td>
                                        <td>Rp. <?=$jumlah?></td>
                                        <td><?=$jasa?></td>
                                        <td><?=$keterangan?></td>
                                        <td><?=$tanggal?></td>
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