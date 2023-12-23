
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if ($_GET['act']=='insert') {
        if (isset($_POST['addSup'])){
            $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $kontak  = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $no_rekening  = mysqli_real_escape_string($conn, trim($_POST['no_rekening']));
            $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));
            //check data ada atau tidak
            $check = "SELECT * FROM supplier WHERE nama = '$nama' AND status = 'Y';";
            $result = mysqli_query($conn, $check);
            if (mysqli_num_rows($result) <= 0) {
                $query = "INSERT INTO supplier (nama, kontak, no_rekening, keterangan, alamat) VALUES ('$nama', '$kontak','$no_rekening', '$keterangan', '$alamat')";
                $execQuery = mysqli_query($conn, $query);
                if ($execQuery){
                    header('location: ../../../main.php?module=dataSup&alert=1');
                } else {
                    header('location: ../../../main.php?module=dataSup&alert=2');
                }
            }
            else {
                header('location: ../../../main.php?module=dataSup&alert=8');
            }
        }
    }
    elseif ($_GET['act']=='edit') {
        if (isset($_POST['editSup'])){
            $id_sup = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));
            $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $kontak  = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $no_rekening  = mysqli_real_escape_string($conn, trim($_POST['no_rekening']));
            $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

            $query = "UPDATE supplier SET nama = '$nama', kontak = '$kontak', no_rekening = '$no_rekening', keterangan = '$keterangan', alamat = '$alamat' WHERE id_supplier = '$id_sup'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataSup&alert=3');
            } else {
                header('location: ../../../main.php?module=dataSup&alert=4');
            }
        }
        
    }
    elseif ($_GET['act']=='delete') {
        if (isset($_POST['delSup'])){
            $id_sup = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));

            $query = "UPDATE supplier SET status = 'N' WHERE id_supplier = '$id_sup'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataSup&alert=5');
            } else {
                header('location: ../../../main.php?module=dataSup&alert=6');
            }
        }
    }
?>
