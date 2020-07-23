<?php
    include("koneksi.php");

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $pass = md5($_POST['pass']);
    $telp = $_POST['telp'];
    $alamat =$_POST['alamat'];
    $tipe = $_POST['tipe'];
    $domisili=$_POST['domisili'];

    if(!$nama || !$email || !$dob || !$pass || !$telp || !$alamat || !$tipe || !$domisili){
        header("location:../register.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "INSERT INTO user (nama_u, email_u, dob_u, telp_u, alamat_u, tanggal_daftar, password_u, level, fk_id_domisili, status_u)
        VALUES ('".$nama."', '".$email."', '".$dob."', '".$telp."','".$alamat."', now(),'".$pass."','".$tipe."','".$domisili."','2')";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
            header("location:../register.php?alert=2");
        }
        else {
            header("location:../register.php?alert=3");
        }
    }
?>