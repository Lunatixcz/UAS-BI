
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";

// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if ($_GET['act']=='insert') {
        if(isset($_POST['addnewperlengkapan'])){
            $perlengkapan = mysqli_real_escape_string($conn, trim($_POST['namaperlengkapan']));
            //check data ada atau tidak
            $check = "SELECT * FROM mobil WHERE prlkpn = '$perlengkapan' AND status = 'Y';";
            $result = mysqli_query($conn, $check);
            if (mysqli_num_rows($result) <= 0) {
                $query = "INSERT INTO mobil (prlkpn) VALUES ('$perlengkapan')";
                $execQuery = mysqli_query($conn, $query);
                if ($execQuery) {
                    //jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../../main.php?module=dataMobil&alert=1");
                } else {
                    header("location: ../../../main.php?module=dataMobil&alert=2");
                }
            }
            else {
                header("location: ../../../main.php?module=dataMobil&alert=8");
            }
            //or die('Ada kesalahan pada query insert : '.mysqli_error($conn));
            // cek query
        }
    }
    elseif ($_GET['act']=='edit') {
        if(isset($_POST['editperlengkapan'])){
            $id_perlengkapan = mysqli_real_escape_string($conn, trim($_POST['id_perlengkapan']));
            $perlengkapan = mysqli_real_escape_string($conn, trim($_POST['namaperlengkapan']));

            $query = "UPDATE mobil SET prlkpn = '$perlengkapan' where id_prlkpn = '$id_perlengkapan' ";
            $execQuery = mysqli_query($conn, $query);
            //or die('Ada kesalahan pada query insert : '.mysqli_error($conn));
            if ($execQuery) {
                //jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../../main.php?module=dataMobil&alert=3");
            } else {
                header("location: ../../../main.php?module=dataMobil&alert=4");
            }
        }
    }
    elseif ($_GET['act']=='delete') {
        if(isset($_POST['deletebarang'])){
            $id_barang = mysqli_real_escape_string($conn, trim($_POST['id_barang']));
            
            $query = "UPDATE barang SET status = 'N' WHERE id_barang = '$id_barang'";
            $execQuery = mysqli_query($conn, $query);
            if($execQuery) {
                //jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../../main.php?module=dataItem&alert=5");
            } else {
                header("location: ../../../main.php?module=dataItem&alert=6");
            }
        }
    }
?>