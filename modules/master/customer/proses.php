
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
require_once "../../../auth/cek.php";
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
    if ($_GET['act']=='insert') {
        echo 'ANjing';
        if (isset($_POST['addCust'])){
            $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $kontak  = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));
            //check data ada atau tidak
            $check = "SELECT * FROM customer WHERE nama = '$nama' AND status = 'Y';";
            $result = mysqli_query($conn, $check);
            if (mysqli_num_rows($result) <= 0) {
                $query = "INSERT INTO customer (nama, kontak, keterangan, alamat) VALUES ('$nama', '$kontak', '$keterangan', '$alamat')";
                $execQuery = mysqli_query($conn, $query);
                if ($execQuery){
                    header('location: ../../../main.php?module=dataCust&alert=1');
                } else {
                    header('location: ../../../main.php?module=dataCust&alert=2');
                }
            }
            else {
                header("location: ../../../main.php?module=dataCust&alert=8");
            }
        }
    }
    elseif ($_GET['act']=='edit') {
        if (isset($_POST['editCust'])){
            $id_cust = mysqli_real_escape_string($conn, trim($_POST['id_customer']));
            $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
            $kontak  = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
            $alamat = floatval(str_replace(['Jln. '], [''],mysqli_real_escape_string($conn, trim($_POST['alamat']))));

            $query = "UPDATE customer SET nama = '$nama', kontak = '$kontak', keterangan = '$keterangan', alamat = '$alamat' WHERE id_customer = '$id_cust'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataCust&alert=3');
            } else {
                header('location: ../../../main.php?module=dataCust&alert=4');
            }
        }
        
    }
    elseif ($_GET['act']=='delete') {
        if (isset($_POST['delCust'])){
            $id_cust = mysqli_real_escape_string($conn, trim($_POST['id_customer']));

            $query = "UPDATE customer SET status = 'N' WHERE id_customer = '$id_cust'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery){
                header('location: ../../../main.php?module=dataCust&alert=5');
            } else {
                header('location: ../../../main.php?module=dataCust&alert=6');
            }
        }
    }
?>
