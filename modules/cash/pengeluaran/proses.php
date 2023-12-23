<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";

if($_GET['act'] == 'insertTempCashKeluar'){
    if(isset($_POST['insertTempCashkeluar'])){
        /* Header Information */
        $last_keluar = mysqli_real_escape_string($conn, trim($_POST['last_keluar']));
        $no_bukti = $_POST['no_bukti'];
        $id_akun = mysqli_real_escape_string($conn, trim($_POST['id_akun']));
        $tanggal_keluar = $_POST['tanggal_keluar'];
        $terima_dari = mysqli_real_escape_string($conn, trim($_POST['terimaDari']));
        $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
        if ($terima_dari == "customer") {
            $dari = $_POST['dariCustomer'];
        } elseif ($terima_dari == "lainnya") {
            $dari = mysqli_real_escape_string($conn, trim($_POST['dariLainnya']));
        } else {
            if ($_POST['dariJasa'] == "-") {
                header('location: ../../../main.php?module=detailCashKeluar&alert=14');
                unset($_SESSION['header_cash_keluar']);
                exit; // Make sure to exit after sending the header
            }
            $dari = mysqli_real_escape_string($conn, trim($_POST['dariJasa']));
        }

        $_SESSION['header_cash_keluar'] =  array(
            'dari' => $dari,
            'last_keluar' => $last_keluar,
            'no_bukti' => $no_bukti,
            'id_akun' => $id_akun,
            'tanggal_keluar' => $tanggal_keluar,
            'terima_dari' => $terima_dari,
            'keterangan' => $keterangan,
        );

        /* end of header information */
        /* Content Information */

        if ($terima_dari == "customer") {
            $barangPenjualan = mysqli_real_escape_string($conn, trim($_POST['barangPenjualan']));
            $uom = mysqli_real_escape_string($conn, trim($_POST['uom']));
            $satuan_kecil = mysqli_real_escape_string($conn, trim($_POST['satuankecil']));
            $kuantitas = mysqli_real_escape_string($conn, trim($_POST['kuantitas']));
            if (isset($_POST['id_jasa'])) {
                $id_jasa = mysqli_real_escape_string($conn, trim($_POST['id_jasa']));
            } else {
                $id_jasa = NULL;
            }
        } elseif ($terima_dari == "lainnya") {
            $barangPenjualan = "";
            $uom = "";
            $satuan_kecil = "";
            $kuantitas = "";
            $id_jasa = "";
        } else {
            $barangPenjualan = "";
            $uom = "";
            $satuan_kecil = "";
            $kuantitas = "";
            $id_jasa = mysqli_real_escape_string($conn, trim($_POST['id_jasa_pihak']));
        }

        $kendaraan = mysqli_real_escape_string($conn, trim($_POST['barangPenjualan']));
        $jumlah = mysqli_real_escape_string($conn, trim($_POST['jumlah']));
        
        $_SESSION['temp_cash_keluar'][] = array(
            'barangPenjualan' => $barangPenjualan,
            'uom' => $uom,
            'satuan_kecil' => $satuan_kecil,
            'id_jasa' => $id_jasa,
            'kuantitas' => $kuantitas,
            'kendaraan' => $kendaraan,
            'jumlah' => $jumlah,
        );
        header('location: ../../../main.php?module=detailCashKeluar');
    }
}

elseif ($_GET['act'] == 'reset'){
    unset($_SESSION['header_cash_keluar']);
    unset($_SESSION['temp_cash_keluar']);

    header('location: ../../../main.php?module=detailCashKeluar');
}

elseif ($_GET['act'] == 'deleteList'){
    if (isset($_POST['deleteList'])){
        $id_list = $_POST['indexhapus'];

        unset($_SESSION['temp_cash_keluar'][$id_list]);

        header('location: ../../../main.php?module=detailCashKeluar');
    }
}
elseif ($_GET['act'] == 'insertCash'){
    if (isset($_POST['insertCash'])){
        $totJumlah = $_POST['totJumlah'];
        $no_bukti = $_SESSION['header_cash_keluar']['no_bukti'];
        $id_akun =  $_SESSION['header_cash_keluar']['id_akun'];
        $tanggal_keluar = $_SESSION['header_cash_keluar']['tanggal_keluar'];
        $terima_dari = $_SESSION['header_cash_keluar']['terima_dari'];
        $last_keluar = $_SESSION['header_cash_keluar']['last_keluar'];
        $keterangan = $_SESSION['header_cash_keluar']['keterangan'];
        $dari = $_SESSION['header_cash_keluar']['dari'];
        
        $queryHeader = "INSERT INTO cash_keluar (bukti_keluar, nomor_keluar, terima_dari, dari, jumlah, id_akun, tanggal_keluar, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $queryHeader);
        mysqli_stmt_bind_param($stmt, 'sssssdss', $no_bukti, $last_keluar, $terima_dari, $dari, $totJumlah, $id_akun, $tanggal_keluar, $keterangan);
        mysqli_stmt_execute($stmt);

        $id_cashkeluar = mysqli_insert_id($conn);
        $temp_cash_keluar = $_SESSION['temp_cash_keluar'];
        $getStockQuery = "SELECT id_barang, kuantitas FROM barang";
        $getStockResult = mysqli_query($conn, $getStockQuery);

        // Create an empty array to store the current stock values
        $currentStock = array();

        while ($row = mysqli_fetch_assoc($getStockResult)) {
            $id_barang = $row['id_barang'];
            $kuantitas = $row['kuantitas'];
            // Store the current stock value in the $currentStock array using the id_barang as the key
            $currentStock[$id_barang] = $kuantitas;
        }

        foreach ($temp_cash_keluar as $key => $data) {
            /* Cek Barang */
            $barang = $data['barangPenjualan'];
            $kuantitas = $data['kuantitas'];
            $jasa = $data['id_jasa'];
            $jumlah = $data['jumlah'];
            $keterangan = $data['keterangan'];

            $queryDetail = "INSERT INTO history_cash_keluar (id_cash_keluar, id_barang, kuantitas, id_jasa, jumlah) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $queryDetail);
            mysqli_stmt_bind_param($stmt, 'iiiii', $id_cashkeluar, $barang, $kuantitas, $jasa, $jumlah);
            mysqli_stmt_execute($stmt);


            if ($terima_dari == "customer"){
             // Update stock quantity in the barang table
             $stock_sekarang = $currentStock[$id_barang];
             $stock_baru = $stock_sekarang + $kuantitas;
             
             $updateKuantitas = "UPDATE barang SET kuantitas = '$stock_baru' WHERE id_barang = '$id_barang'";
             $execUpdateKuantitas = mysqli_query($conn, $updateKuantitas);
             
             // Update the current stock value in the $currentStock array
             $currentStock[$id_barang] = $stock_baru;
             }
        }

    }
    $queryAkun = "INSERT INTO history_akun (id_akun , id_ckeluar , kredit) VALUES ('$id_akun','$id_cashkeluar','$jumlah')";
    $execakun = mysqli_query($conn, $queryAkun);
    
    $queryjumlah ="SELECT *
                    FROM cash_keluar
                    INNER JOIN akun ON cash_keluar.id_akun = akun.id_akun
                    WHERE akun.id_akun = $id_akun;";

    $exectambahjumlah = mysqli_query($conn, $queryjumlah);

    while ($datatambahjumlah = mysqli_fetch_array($exectambahjumlah)){
        $id_akun= $datatambahjumlah['id_akun'];
        $kredit = (int)$datatambahjumlah['kredit'];
        $jumlah = (int)$datatambahjumlah['jumlah'];
        
        $jumlahbaru = $jumlah + $kredit;
        
        $insertjumlah = "UPDATE akun SET debit = '$jumlahbaru' WHERE id_akun = '$id_akun'";
        $execinsertJumlah = mysqli_query($conn, $insertjumlah);
    }

    unset($_SESSION['header_cash_keluar']);
    unset($_SESSION['temp_cash_keluar']);
    header('location: ../../../main.php?module=cashKeluar');
}
?>