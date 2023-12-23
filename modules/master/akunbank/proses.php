
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if ($_GET['act']=='insert') {
        if (isset($_POST['addAcc'])){
            $tipe_akun = mysqli_real_escape_string($conn, trim($_POST['tipe_akun']));
            $nomor_akun  = mysqli_real_escape_string($conn, trim($_POST['nomor_akun']));
            //check data ada atau tidak
            $check = "SELECT * FROM tipe_akun WHERE nomor_akun = '$nomor_akun'";
            $result = mysqli_query($conn, $check);
            if (mysqli_num_rows($result) <= 0) {
                $query = "INSERT INTO tipe_akun (tipe_akun, nomor_akun) VALUES ('$tipe_akun', '$nomor_akun')";
                $execQuery = mysqli_query($conn, $query);
                if ($execQuery){
                    header('location: ../../../main.php?module=noAcc&alert=1');
                } else {
                    header('location: ../../../main.php?module=noAcc&alert=2');
                }
            }
            else {
                header('location: ../../../main.php?module=noAcc&alert=8');
            }
        }
    }
    elseif ($_GET['act']=='edit') {
        if (isset($_POST['editAcc'])){
            $id_tipe = mysqli_real_escape_string($conn, trim($_POST['id_tipe']));
            $tipe_akun = mysqli_real_escape_string($conn, trim($_POST['tipe_akun']));
            $nomor_akun  = mysqli_real_escape_string($conn, trim($_POST['nomor_akun']));

            $query = "UPDATE tipe_akun SET tipe_akun = '$tipe_akun', nomor_akun = '$nomor_akun' WHERE id_tipe = '$id_tipe'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=noAcc&alert=3');
            } else {
                header('location: ../../../main.php?module=noAcc&alert=4');
            }
        }
        
    }
    elseif ($_GET['act']=='delete') {
        if (isset($_POST['delSup'])){
            $id_sup = mysqli_real_escape_string($conn, trim($_POST['id_supplier']));

            $query = "DELETE FROM supplier WHERE id_supplier = '$id_sup'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=noAcc&alert=5');
            } else {
                header('location: ../../../main.php?module=noAcc&alert=6');
            }
        }
    }
    if ($_GET['act']=='insertsubacc') {
        if (isset($_POST['addsubAcc'])){
            $id_tipe = mysqli_real_escape_string($conn, trim($_POST['id_tipe']));
            $no_trans  = mysqli_real_escape_string($conn, trim($_POST['no_trans']));
            $nomor_akun  = mysqli_real_escape_string($conn, trim($_POST['nomor_akun']));
            $nama_akun  = mysqli_real_escape_string($conn, trim($_POST['nama_akun']));
        
            $query = "INSERT INTO akun (nomor_transaksi, kode_akun, nama_akun ,tipe_akun) VALUES ('$no_trans', '$nomor_akun' , '$nama_akun' , '$id_tipe')";
            $execQuery = mysqli_query($conn, $query);
            if ($execQuery){
                header('location: ../../../main.php?module=detailAkun&id_tipe='.$id_tipe.'&alert=1');
            } else {
                header('location: ../../../main.php?module=detailAkun&id_tipe='.$id_tipe.'&alert=2');
            }
            
        }
    }
?>
