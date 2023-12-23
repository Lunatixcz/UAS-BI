<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if($_GET['act']=='inserttemp'){
        if(isset($_POST['inserttemp'])){
            $no_transaksi = mysqli_real_escape_string($conn, trim($_POST['nomor_transaksi']));
            $no_faktur = mysqli_real_escape_string($conn, trim($_POST['no_faktur']));
            $id_customer = mysqli_real_escape_string($conn, trim($_POST['id_customer']));
            $jatuh_tempo = mysqli_real_escape_string($conn, trim($_POST['jatuh_tempo']));
            $kendaraan = $_POST['kendaraan'];

            // store the variables in the session
            $_SESSION['temp_transaksi_jual'] = array(
                'no_transaksi' => $no_transaksi,
                'no_faktur' => $no_faktur,
                'id_customer' => $id_customer,
                'jatuh_tempo' => $jatuh_tempo,
                'kendaraan' => $kendaraan
            );

            $uom = $_POST['uom'];
            $satuan_kecil = $_POST['satuankecil'];
            $kuantitas = $_POST['kuantitas'];

            if ($uom == 'besar') {
                $kuantitas = $kuantitas * $satuan_kecil;
            }

            $faktur_barang = trim($_POST['no_faktur']);
            $id_barang = mysqli_real_escape_string($conn, trim($_POST['id_barang_penjualan']));
            $harga_barang = floatval(str_replace(['Rp. ', '.'], ['', ''],mysqli_real_escape_string($conn, trim($_POST['harga_barang']))));
            $disc =  mysqli_real_escape_string($conn, trim($_POST['disc']));
            $harga_modal = trim($_POST['harga_modal']);
            $bruto = ($kuantitas*$harga_barang);
            $diskon = ($bruto * ($disc/100));
            $netto = $bruto - $diskon;
            $user = $_SESSION['username'];

            $pendapatan = $bruto - ($harga_modal * $kuantitas);

            // get data from database
            $getStock = mysqli_query($conn, "SELECT kuantitas FROM barang WHERE id_barang='$id_barang'");
            $data = mysqli_fetch_assoc($getStock);
            $stock_sekarang = $data['kuantitas'];

            // check if stock is enough
            if($kuantitas > $stock_sekarang){
                header ('location: ../../../main.php?module=detailPenjualan&alert=7');
            }
            else{
                if (!isset($_SESSION['temp_data_jual'])) {
                    $_SESSION['temp_data_jual'] = array();
                }
    
                // Create a session array for transaction items
                $_SESSION['temp_data_jual'][] = array(
                    'faktur_barang' => $faktur_barang,
                    'id_barang' => $id_barang,
                    'kuantitas' => $kuantitas,
                    'id_customer' => $id_customer,
                    'harga_barang' => $harga_barang,
                    'pendapatan' => $pendapatan,
                    'disc' => $disc,
                    'bruto' => $bruto,
                    'netto' => $netto,
                    'user' => $user,
                    'diskon' => $diskon
                );
                header('location: ../../../main.php?module=detailPenjualan');
            }
            
        }
    } 

    elseif ($_GET['act'] == 'insertTempJasa'){
        if (isset($_POST['insertTempJasa'])){
            $id_jasa = mysqli_real_escape_string($conn, trim($_POST['id_jasa']));
            $harga_jasa = mysqli_real_escape_string($conn, trim($_POST['harga_jasa']));
            $modal_jasa = mysqli_real_escape_string($conn, trim($_POST['modal_jasa']));
            $deskripsi = mysqli_real_escape_string($conn, trim($_POST['deskripsi_jasa']));

            $pendapatan = $harga_jasa - $modal_jasa;

            $_SESSION['temp_jasa'][] =  array (
                'id_jasa' => $id_jasa,
                'harga_jasa' => $harga_jasa,
                'pendapatan' => $pendapatan,
                'deskripsi' => $deskripsi,
            );
            header('location: ../../../main.php?module=detailPenjualan');
        }
    }

    

    elseif ($_GET['act'] == 'deleteList'){
        if (isset($_POST['deleteList'])){
            $id_list = $_POST['indeks'];

            unset($_SESSION['temp_data_jual'][$id_list]);

            header('location: ../../../main.php?module=detailPenjualan');
        }
    }

    elseif ($_GET['act'] == 'deleteJasa'){
        if (isset($_POST['deleteJasa'])){
            $id_jasa = $_POST['indeks'];

            unset($_SESSION['temp_jasa'][$id_jasa]);

            header('location: ../../../main.php?module=detailPenjualan');
        }
    }

    elseif ($_GET['act'] == 'reset'){
            unset($_SESSION['temp_transaksi_jual']);
            unset($_SESSION['temp_data_jual']);
            unset($_SESSION['temp_jasa']);

            header('location: ../../../main.php?module=detailPenjualan');
        
    }

    elseif ($_GET['act'] == 'sell'){
        if(isset($_POST['buy'])){
            $id_penjualan = mysqli_real_escape_string($conn, trim($_POST['id_penjualan']));
            $id_akun = mysqli_real_escape_string($conn, trim($_POST['id_akun']));
            $netto = mysqli_real_escape_string($conn , $_POST['jumlah']);
            $netto = str_replace('.', '', $netto);

            $query = "UPDATE penjualan SET status_pembayaran = 'Y' WHERE id_penjualan in ($id_penjualan)";
            $execQuery = mysqli_query($conn, $query);

            $queryjumlah ="SELECT * from akun where id_akun = $id_akun";
            $exectambahjumlah = mysqli_query($conn, $queryjumlah);

            while ($datatambahjumlah = mysqli_fetch_array($exectambahjumlah)){
                $id_akun= $datatambahjumlah['id_akun'];
                $debit = (int)$datatambahjumlah['debit'];
                
                $jumlahbaru = $netto + $debit;
                
                $insertjumlah = "UPDATE akun SET debit = '$jumlahbaru' WHERE id_akun = '$id_akun'";
                $execinsertJumlah = mysqli_query($conn, $insertjumlah);
            }

            $queryDetail ="SELECT id_penjualan , netto from penjualan where id_penjualan in ($id_penjualan)";
            $execquerydetail = mysqli_query($conn, $queryDetail);

            while ($datadetail = mysqli_fetch_array($execquerydetail)){
                $id_penjualan = $datadetail['id_penjualan'];
                $netto = $datadetail['netto'];

                $queryAkun = "INSERT INTO history_akun (id_akun , id_penjualan , debit) VALUES ('$id_akun','$id_penjualan','$netto')";
                $execakun = mysqli_query($conn, $queryAkun);
            }
            header('location: ../../../main.php?module=sellItem');
        }
    }

    elseif ($_GET['act'] == 'insertPenjualan') {
        if (isset($_POST['insertPenjualan'])) {
            $temp_transaksi_jual = $_SESSION['temp_transaksi_jual'];
            $no_transaksi = $temp_transaksi_jual['no_transaksi'];
            $no_faktur = $temp_transaksi_jual['no_faktur'];
            $id_customer = $temp_transaksi_jual['id_customer'];
            $jatuh_tempo = $temp_transaksi_jual['jatuh_tempo'];
            $kendaraan = htmlspecialchars($temp_transaksi_jual['kendaraan'], ENT_QUOTES, 'UTF-8');;
            $totNetto = $_SESSION['totNetto'];
            $creator = $_SESSION['username'];
            
            $queryHeader = "INSERT INTO penjualan (no_faktur, id_customer,nomor_transaksi,plat,jatuh_tempo, netto, creator) 
                            VALUES ('$no_faktur', '$id_customer', '$no_transaksi','$kendaraan','$jatuh_tempo', '$totNetto', '$creator')";
            $execQueryHeader = mysqli_query($conn, $queryHeader) or die('Error inserting data into penjualan table: ' . mysqli_error($conn));
            $id_penjualan = mysqli_insert_id($conn);
    
            // Insert data from temp_data_jual table
            $temp_data_jual = $_SESSION['temp_data_jual'];

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

            foreach ($temp_data_jual as $data) {
                $id_barang = $data['id_barang'];
                $id_customer = $data['id_customer'];
                $kuantitas = $data['kuantitas'];
                $harga_barang = $data['harga_barang'];
                $pendapatan = $data['pendapatan'];
                $disc = $data['disc'];
                $bruto = $data['bruto'];
                $netto = $data['netto'];
                $user = $data['user'];
                $diskon = $data['diskon'];
    
                $queryDetail = "INSERT INTO history_penjualan (id_penjualan, id_customer, id_barang, kuantitas, harga_barang,pendapatan, disc, diskon, bruto, netto, user) 
                                VALUES ('$id_penjualan', '$id_customer', '$id_barang', '$kuantitas', '$harga_barang','$pendapatan', '$disc', '$diskon', '$bruto', '$netto', '$user')";
                $execQueryDetail = mysqli_query($conn, $queryDetail) or die('Error inserting data into penjualan_detail table: ' . mysqli_error($conn));

                 // Update stock quantity in the barang table
                 $stock_sekarang = $currentStock[$id_barang];
                 $stock_baru = $stock_sekarang - $kuantitas;
                 
                 $updateKuantitas = "UPDATE barang SET kuantitas = '$stock_baru' WHERE id_barang = '$id_barang'";
                 $execUpdateKuantitas = mysqli_query($conn, $updateKuantitas);
                 
                 // Update the current stock value in the $currentStock array
                 $currentStock[$id_barang] = $stock_baru;
 
            }

            $queryPendapatan = "SELECT id_penjualan, SUM(pendapatan) AS total_pendapatan FROM history_penjualan where id_penjualan = '$id_penjualan';";
            $execQueryPendapatan = mysqli_query($conn, $queryPendapatan) or die('Error inserting data into penjualan_detail table: ' . mysqli_error($conn));

            while ($row = mysqli_fetch_assoc($execQueryPendapatan)) {
                $pendapatan = $row['total_pendapatan'];
                $queryInsertPendapatan = "UPDATE penjualan set pendapatan = '$pendapatan' WHERE id_penjualan = '$id_penjualan'";
                $execQueryInsertPendapatan = mysqli_query($conn, $queryInsertPendapatan) or die('Error inserting data into penjualan_detail table: ' . mysqli_error($conn));
            }
            

            $temp_jasa = $_SESSION['temp_jasa'];
            foreach ($temp_jasa as $data) {
                $id_jasa = $data['id_jasa'];
                $harga_jasa = $data['harga_jasa'];
                $deskripsi = $data['deskripsi'];
                $pendapatan = $data['pendapatan'];

                $queryJasa = "INSERT INTO history_jasa (id_jasa, id_penjualan, harga_jasa,pendapatan, deskripsi)
                                VALUES ('$id_jasa', '$id_penjualan', '$harga_jasa','$pendapatan', '$deskripsi')";
                $execQueryJasa = mysqli_query($conn, $queryJasa) or die('Error inserting data into penjualan_detail table: ' . mysqli_error($conn));
            }
            
         
            // Clear session data after successful insertions
            unset($_SESSION['temp_transaksi_jual']);
            unset($_SESSION['temp_data_jual']);
            unset($_SESSION['temp_jasa']);
    
            header('location: ../../../main.php?module=sellItem');

        }
    }
    
?>
