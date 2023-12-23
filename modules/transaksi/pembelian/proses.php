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
            $id_supplier = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));
            $jatuh_tempo = mysqli_real_escape_string($conn, trim($_POST['jatuh_tempo']));

            // store the variables in the session
            $_SESSION['temp_transaksi_beli'] = array(
                'no_transaksi' => $no_transaksi,
                'no_faktur' => $no_faktur,
                'id_supplier' => $id_supplier,
                'jatuh_tempo' => $jatuh_tempo
            );
            $faktur_barang = trim($_POST['no_faktur']);
            $id_barang = mysqli_real_escape_string($conn, trim($_POST['id_barang']));
            
            $uom = $_POST['uom'];
            $satuan_kecil = $_POST['satuan_kecil'];
            $kuantitas = $_POST['kuantitas'];
            $kuantitas = str_replace('.', '', $kuantitas);

            if ($uom == 'besar') {
            $kuantitas = $kuantitas * $satuan_kecil;
            }

            $harga_barang = floatval(str_replace(['Rp. ', '.'], ['', ''],mysqli_real_escape_string($conn, trim($_POST['harga_barang']))));
            $disc =  floatval(str_replace(['%'], [''],mysqli_real_escape_string($conn, trim($_POST['disc']))));
            $bruto = ($kuantitas*$harga_barang);
            $diskon = ($bruto * ($disc/100));
            $netto = $bruto - $diskon;
            $user = $_SESSION['username'];

            if (!isset($_SESSION['temp_data_beli'])) {
                $_SESSION['temp_data_beli'] = array();
            }
            // Create a session array for transaction items
            $_SESSION['temp_data_beli'][] = array(
                'faktur_barang' => $faktur_barang,
                'id_barang' => $id_barang,
                'kuantitas' => $kuantitas,
                'id_supplier' => $id_supplier,
                'harga_barang' => $harga_barang,
                'disc' => $disc,
                'bruto' => $bruto,
                'netto' => $netto,
                'user' => $user,
                'diskon' => $diskon
            );

            header('location: ../../../main.php?module=detailPembelian');
        }
    }
    
    elseif ($_GET['act'] == 'deleteList'){
        if (isset($_POST['deleteList'])){
            $id_list = $_POST['indeks'];

            unset($_SESSION['temp_data_beli'][$id_list]);

            header('location: ../../../main.php?module=detailPembelian');
        }
    }
    elseif ($_GET['act'] == 'reset'){
            unset($_SESSION['temp_transaksi_beli']);
            unset($_SESSION['temp_data_beli']);

            header('location: ../../../main.php?module=detailPembelian');
        
    }

    elseif ($_GET['act'] == 'buy'){
        if(isset($_POST['buy'])){
            $id_pembelian = mysqli_real_escape_string($conn, trim($_POST['id_pembelian']));
            $id_akun = mysqli_real_escape_string($conn, trim($_POST['id_akun']));
            $netto = mysqli_real_escape_string($conn , $_POST['jumlah']);
            $netto = str_replace('.', '', $netto);

            $query = "UPDATE pembelian SET status_pembayaran = 'Y' WHERE id_pembelian in ($id_pembelian)";
            $execQuery = mysqli_query($conn, $query);

            $queryjumlah ="SELECT * from akun where id_akun = $id_akun";
            $exectambahjumlah = mysqli_query($conn, $queryjumlah);

            while ($datatambahjumlah = mysqli_fetch_array($exectambahjumlah)){
                $id_akun= $datatambahjumlah['id_akun'];
                $kredit = (int)$datatambahjumlah['kredit'];
                
                $jumlahbaru = $netto + $kredit;
                
                $insertjumlah = "UPDATE akun SET kredit = '$jumlahbaru' WHERE id_akun = '$id_akun'";
                $execinsertJumlah = mysqli_query($conn, $insertjumlah);
            }

            // Convert the string to an array of characters
            $values = explode(',', $id_pembelian);

            foreach($values as $value){
                // Sanitize and validate the character (you should implement proper validation)
                $value = mysqli_real_escape_string($conn, $value);
                
                $querypembelian ="SELECT * from pembelian where id_pembelian = '$value'";
                $execpembelian = mysqli_query($conn, $querypembelian);
                $row = mysqli_fetch_assoc($execpembelian);

                $netto = $row['netto'];

                $queryAkun = "INSERT INTO history_akun (id_akun , id_pembelian , kredit) VALUES ('$id_akun','$value','$netto')";
                $execakun = mysqli_query($conn, $queryAkun);
            }
            
            header('location: ../../../main.php?module=buyItem');
        }
    }

    elseif ($_GET['act'] == 'insertPembelian') {
        if (isset($_POST['insertPembelian'])) {
            $temp_transaksi_beli = $_SESSION['temp_transaksi_beli'];
            $no_transaksi = $temp_transaksi_beli['no_transaksi'];
            $no_faktur = $temp_transaksi_beli['no_faktur'];
            $id_supplier = $temp_transaksi_beli['id_supplier'];
            $jatuh_tempo = $temp_transaksi_beli['jatuh_tempo'];
            $totNetto = $_SESSION['totNetto'];
            $creator = $_SESSION['username'];
            
            $queryHeader = "INSERT INTO pembelian (no_faktur, id_supplier, nomor_transaksi, jatuh_tempo, netto, creator) 
                            VALUES ('$no_faktur', '$id_supplier', '$no_transaksi', '$jatuh_tempo', '$totNetto', '$creator')";
            $execQueryHeader = mysqli_query($conn, $queryHeader) or die('Error inserting data into pembelian table: ' . mysqli_error($conn));
            $id_pembelian = mysqli_insert_id($conn);
    
            // Insert data from temp_data_beli table
            $temp_data_beli = $_SESSION['temp_data_beli'];
            
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
            

            foreach ($temp_data_beli as $data) {
                $id_barang = $data['id_barang'];
                $id_supplier = $data['id_supplier'];
                $kuantitas = $data['kuantitas'];
                $harga_barang = $data['harga_barang'];
                $disc = $data['disc'];
                $bruto = $data['bruto'];
                $netto = $data['netto'];
                $user = $data['user'];
                $diskon = $data['diskon'];
    
                $queryDetail = "INSERT INTO history_pembelian (id_pembelian, id_supplier, id_barang, kuantitas, harga_barang, disc, diskon, bruto, netto, user) 
                                VALUES ('$id_pembelian', '$id_supplier', '$id_barang', '$kuantitas', '$harga_barang', '$disc', '$diskon', '$bruto', '$netto', '$user')";
                $execQueryDetail = mysqli_query($conn, $queryDetail) or die('Error inserting data into pembelian_detail table: ' . mysqli_error($conn));

                 // Update stock quantity in the barang table
                $stock_sekarang = $currentStock[$id_barang];
                $stock_baru = $stock_sekarang + $kuantitas;
                
                $updateKuantitas = "UPDATE barang SET kuantitas = '$stock_baru' WHERE id_barang = '$id_barang'";
                $execUpdateKuantitas = mysqli_query($conn, $updateKuantitas);
                
                // Update the current stock value in the $currentStock array
                $currentStock[$id_barang] = $stock_baru;

            }

            
            
            // Clear session data after successful insertions
            unset($_SESSION['temp_transaksi_beli']);
            unset($_SESSION['temp_data_beli']);
    
            header('location: ../../../main.php?module=buyItem');

        }
    }
    
?>