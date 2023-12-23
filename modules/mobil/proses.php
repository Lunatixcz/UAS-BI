<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if($_GET['act']=='inserttemp'){
        if(isset($_POST['inserttemp'])){
            $merk = mysqli_real_escape_string($conn, trim($_POST['merk']));
            $plat = mysqli_real_escape_string($conn, trim($_POST['plat']));
            $tanggal_periksa = mysqli_real_escape_string($conn, trim($_POST['tanggal_periksa']));
            $pemeriksa = mysqli_real_escape_string($conn, trim($_POST['pemeriksa']));
            $servis = mysqli_real_escape_string($conn, trim($_POST['servis']));

            // store the variables in the session
            $_SESSION['temp_transaksi_mobil'] = array(
                'merk' => $merk,
                'plat' => $plat,
                'tanggal_periksa' => $tanggal_periksa,
                'pemeriksa' => $pemeriksa,
                'servis' => $servis
            );
            
            $id_perlengkapan = mysqli_real_escape_string($conn, trim($_POST['id_perlengkapan']));
            $kondisi = isset($_POST['kondisi']) ? mysqli_real_escape_string($conn, trim($_POST['kondisi'])) : "-";
            $perlengkapan = mysqli_real_escape_string($conn, trim($_POST['perlengkapan']));
            $user = $_SESSION['username'];

            if (!isset($_SESSION['temp_data_perlengkapan'])) {
                $_SESSION['temp_data_perlengkapan'] = array();
            }
            // Create a session array for transaction items
            $_SESSION['temp_data_perlengkapan'][] = array(
                'id_perlengkapan' => $id_perlengkapan,
                'kondisi' => $kondisi,
                'perlengkapan' => $perlengkapan,
                'user' => $user,
            );

            header('location: ../../main.php?module=detailMobil');
        }
    }
    
    elseif ($_GET['act'] == 'deleteList'){
        if (isset($_POST['deleteList'])){
            $id_list = $_POST['indeks'];

            unset($_SESSION['temp_data_perlengkapan'][$id_list]);

            header('location: ../../main.php?module=detailMobil');
        }
    }
    elseif ($_GET['act'] == 'reset'){
            unset($_SESSION['temp_transaksi_mobil']);
            unset($_SESSION['temp_data_perlengkapan']);

            header('location: ../../main.php?module=detailMobil');
        
    }

    elseif ($_GET['act'] == 'buy'){
        if(isset($_POST['buy'])){
            $id_pembelian = mysqli_real_escape_string($conn, trim($_POST['id_pembelian']));

            $query = "UPDATE pembelian SET status_pembayaran = 'Y' WHERE id_pembelian = '$id_pembelian'";
            $execQuery = mysqli_query($conn, $query);

            header('location: ../../main.php?module=buyItem');
        }
    }

    elseif ($_GET['act'] == 'insertMobil') {
        if (isset($_POST['insertMobil'])) {
            $temp_transaksi_mobil = $_SESSION['temp_transaksi_mobil'];
            $merk = $temp_transaksi_mobil['merk'];
            $plat = $temp_transaksi_mobil['plat'];
            $tanggal_periksa = $temp_transaksi_mobil['tanggal_periksa'];
            $pemeriksa = $temp_transaksi_mobil['pemeriksa'];
            $servis = $temp_transaksi_mobil['servis'];

            $creator = $_SESSION['username'];
            
            $queryHeader = "INSERT INTO data_mobil (merk,plat,tanggal,pemeriksa,servis, creator) 
                            VALUES ('$merk','$plat','$tanggal_periksa','$pemeriksa','$servis', '$creator')";
            $execQueryHeader = mysqli_query($conn, $queryHeader) or die('Error inserting data into pembelian table: ' . mysqli_error($conn));
            $id_mobil = mysqli_insert_id($conn);
            
            // Insert data from temp_data_beli table
            $temp_data_perlengkapan = $_SESSION['temp_data_perlengkapan'];
            foreach ($temp_data_perlengkapan as $data) {
                $id_perlengkapan= $data['id_perlengkapan'];
                $kondisi = $data['kondisi'];
                $perlengkapan = $data['perlengkapan'];
                $user = $data['user'];
                
    
                $queryDetail = "INSERT INTO history_mobil (id_mobil, id_perlengkapan ,kondisi , perlengkapan, creator) 
                                VALUES ('$id_mobil', '$id_perlengkapan', '$kondisi', '$perlengkapan' ,'$user')";
                $execQueryDetail = mysqli_query($conn, $queryDetail) or die('Error inserting data into history_mobil table: ' . mysqli_error($conn));
            }
            
           
            // Clear session data after successful insertions
            unset($_SESSION['temp_transaksi_mobil']);
            unset($_SESSION['temp_data_perlengkapan']);
    
            header('location: ../../main.php?module=cekMobil');

        }
    }
    
?>
