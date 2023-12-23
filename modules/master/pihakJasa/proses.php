<?php
    session_start();

    require_once "../../../config/database.php";

    require_once "../../../auth/cek.php";
    
    if($_GET['act'] == 'insert'){
        if(isset($_POST['addPihakJasa'])){
            $nama = mysqli_real_escape_string($conn, trim($_POST['namaPihak']));
            $kontak = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

            $check = "SELECT * FROM pihak_jasa WHERE nama_pihak = '$nama' AND status = 'Y';";
            $result = mysqli_query($conn, $check);
            if (mysqli_num_rows($result) <= 0) {
                $query = "INSERT INTO pihak_jasa (nama_pihak, kontak, alamat) VALUES ('$nama','$kontak','$alamat')";
                //                                          Add a closing parenthesis here ^
                $execQuery = mysqli_query($conn, $query);
                if ($execQuery) {
                    // If successful, display a success message
                    header("location: ../../../main.php?module=pihakJasa&alert=1");
                } else {
                    // If unsuccessful, display an error message
                    header("location: ../../../main.php?module=pihakJasa&alert=2");
                }
            } else {
                // If there are already matching rows, display a different message
                header("location: ../../../main.php?module=pihakJasa&alert=8");
            }
        }
    } 
    elseif($_GET['act'] == 'edit'){
        if(isset($_POST['editJasa'])){
            $id_pjasa = mysqli_real_escape_string($conn, trim($_POST['id_pjasa']));
            $nama = mysqli_real_escape_string($conn, trim($_POST['namaPihak']));
            $kontak = mysqli_real_escape_string($conn, trim($_POST['kontak']));
            $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

            $query = "UPDATE pihak_jasa SET nama_pihak = '$nama', kontak = '$kontak',  alamat = '$alamat' WHERE id_pjasa = '$id_pjasa'";
            $execQuery = mysqli_query($conn, $query);

            if ($execQuery) {
                //jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../../main.php?module=pihakJasa&alert=3");
            } else {
                header("location: ../../../main.php?module=pihakJasa&alert=4");
            }
        }
    }
    elseif ($_GET['act']=='delete') {
        if(isset($_POST['deletePihak'])){
            $id_pjasa = mysqli_real_escape_string($conn, trim($_POST['id_pjasa']));
            
            $query = "UPDATE pihak_jasa SET status = 'N' WHERE id_pjasa = '$id_pjasa'";
            $execQuery = mysqli_query($conn, $query);
            if($execQuery) {
                //jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../../main.php?module=pihakJasa&alert=5");
            } else {
                header("location: ../../../main.php?module=pihakJasa&alert=6");
            }
        }
    }
?>