<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";

if($_GET['act'] == 'insertTempCashMasuk'){
    if(isset($_POST['insertTempCashMasuk'])){
        /* Header Information */
        $last_masuk = mysqli_real_escape_string($conn, trim($_POST['last_masuk']));
        $no_bukti = mysqli_real_escape_string($conn, trim($_POST['no_bukti']));
        $id_akun = mysqli_real_escape_string($conn, trim($_POST['id_akun']));
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $terima_dari = mysqli_real_escape_string($conn, trim($_POST['terimaDari']));
        $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
        if ($terima_dari == "customer") {
            $sumber = $_POST['sumberCustomer'];
        } else {
            $sumber = mysqli_real_escape_string($conn, trim($_POST['sumberLainnya']));
        }

        $_SESSION['header_cash_masuk'] =  array(
            'sumber' => $sumber,
            'last_masuk' => $last_masuk,
            'no_bukti' => $no_bukti,
            'id_akun' => $id_akun,
            'tanggal_masuk' => $tanggal_masuk,
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
            if ($uom == 'besar') {
                $kuantitas = $kuantitas * $satuan_kecil;
                }
            $id_jasa = mysqli_real_escape_string($conn, trim($_POST['id_jasa']));
            if ($_POST['barangPenjualan'] == "" && $_POST['id_jasa'] == "") {
                header('location: ../../../main.php?module=detailCashMasuk&alert=14');
                unset($_SESSION['header_cash_masuk']);
                exit; // Make sure to exit after sending the header

            }
        } else {
            $barangPenjualan = "";
            $uom = "";
            $satuan_kecil = "";
            $kuantitas = "";
            $id_jasa = "";
        }
        $kendaraan = mysqli_real_escape_string($conn, trim($_POST['barangPenjualan']));
        $jumlah = mysqli_real_escape_string($conn, trim($_POST['jumlah']));
        
        $_SESSION['temp_cash_masuk'][] = array(
            'barangPenjualan' => $barangPenjualan,
            'uom' => $uom,
            'satuan_kecil' => $satuan_kecil,
            'id_jasa' => $id_jasa,
            'kuantitas' => $kuantitas,
            'kendaraan' => $kendaraan,
            'jumlah' => $jumlah,
            
        );

        header('location: ../../../main.php?module=detailCashMasuk');
    }
}

elseif ($_GET['act'] == 'reset'){
    unset($_SESSION['header_cash_masuk']);
    unset($_SESSION['temp_cash_masuk']);

    header('location: ../../../main.php?module=detailCashMasuk');
}

elseif ($_GET['act'] == 'deleteList'){
    if (isset($_POST['deleteList'])){
        $id_list = $_POST['indexhapus'];

        unset($_SESSION['temp_cash_masuk'][$id_list]);

        header('location: ../../../main.php?module=detailCashMasuk');
    }
}
elseif ($_GET['act'] == 'insertCash'){
    if (isset($_POST['insertCash'])){
        $totJumlah = $_POST['totJumlah'];
        $no_bukti = $_SESSION['header_cash_masuk']['no_bukti'];
        $id_akun =  $_SESSION['header_cash_masuk']['id_akun'];
        $tanggal_masuk = $_SESSION['header_cash_masuk']['tanggal_masuk'];
        $terima_dari = $_SESSION['header_cash_masuk']['terima_dari'];
        $last_masuk = $_SESSION['header_cash_masuk']['last_masuk'];
        $keterangan = $_SESSION['header_cash_masuk']['keterangan'];
        $sumber = $_SESSION['header_cash_masuk']['sumber'];
        
        $queryHeader = "INSERT INTO cash_masuk (bukti_masuk, nomor_masuk, terima_dari, sumber, jumlah, id_akun, tanggal_masuk, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $queryHeader);
        mysqli_stmt_bind_param($stmt, 'sssssdss', $no_bukti, $last_masuk, $terima_dari, $sumber, $totJumlah, $id_akun, $tanggal_masuk, $keterangan);
        mysqli_stmt_execute($stmt);

        $id_cashMasuk = mysqli_insert_id($conn);


        $temp_cash_masuk = $_SESSION['temp_cash_masuk'];
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
        foreach ($temp_cash_masuk as $key => $data) {
            /* Cek Barang */
            $barang = $data['barangPenjualan'];
            $kuantitas = $data['kuantitas'];
            $jasa = $data['id_jasa'];
            $jumlah = $data['jumlah'];
            $keterangan = $data['keterangan'];

            $queryDetail = "INSERT INTO history_cash_masuk (id_cash_masuk, id_barang, kuantitas, jasa, jumlah) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $queryDetail);
            mysqli_stmt_bind_param($stmt, 'iiiii', $id_cashMasuk, $barang, $kuantitas, $jasa, $jumlah);
            mysqli_stmt_execute($stmt);

             // Update stock quantity in the barang table
             if ($terima_dari == "customer"){
                $stock_sekarang = $currentStock[$id_barang];
                $stock_baru = $stock_sekarang - $kuantitas;
                
                $updateKuantitas = "UPDATE barang SET kuantitas = '$stock_baru' WHERE id_barang = '$id_barang'";
                $execUpdateKuantitas = mysqli_query($conn, $updateKuantitas);
                
                // Update the current stock value in the $currentStock array
                $currentStock[$id_barang] = $stock_baru;
             } 
        }

        


    }
    $queryAkun = "INSERT INTO history_akun (id_akun , id_cmasuk , debit) VALUES ('$id_akun','$id_cashMasuk','$jumlah')";
    $execakun = mysqli_query($conn, $queryAkun);


    $queryjumlah ="SELECT *
                    FROM cash_masuk
                    INNER JOIN akun ON cash_masuk.id_akun = akun.id_akun
                    WHERE akun.id_akun = $id_akun;";

    $exectambahjumlah = mysqli_query($conn, $queryjumlah);

    while ($datatambahjumlah = mysqli_fetch_array($exectambahjumlah)){
        $id_akun= $datatambahjumlah['id_akun'];
        $debit = (int)$datatambahjumlah['debit'];
        $jumlah = (int)$datatambahjumlah['jumlah'];
        
        $jumlahbaru = $jumlah + $debit;
        
        $insertjumlah = "UPDATE akun SET debit = '$jumlahbaru' WHERE id_akun = '$id_akun'";
        $execinsertJumlah = mysqli_query($conn, $insertjumlah);
    }

    unset($_SESSION['header_cash_masuk']);
    unset($_SESSION['temp_cash_masuk']);
    header('location: ../../../main.php?module=cashMasuk');
}
?>