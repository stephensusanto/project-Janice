<?php
    include("koneksi.php");

     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $dob = $_POST['dob'];
     $pass = md5($_POST['pass']);
     $telp = $_POST['telp'];
     $alamat =$_POST['alamat'];
    //echo $tipe = $_POST['tipe'];
     $domisili=$_POST['domisili'];
     $kodepos = $_POST['kodepos'];
     $blok = $_POST['blok'];

    if ($nama == '' || $email== '' || $dob == '' || $pass == '' || $telp== '' || $alamat== ''  || $domisili== '' || $blok == ''|| $kodepos== '' ){
        //header("location:../register.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $alamat = $alamat." ".$blok.", ".$kodepos;
        echo $query = "INSERT INTO user (nama_u, email_u, dob_u, telp_u, alamat_u, tanggal_daftar, password_u, fk_id_level, fk_id_domisili, status_u)
        VALUES ('".$nama."', '".$email."', '".$dob."', '".$telp."','".$alamat."', now(),'".$pass."','3','".$domisili."','2')";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
           
           header("location:../register.php?alert=2");
        }
        else {
           header("location:../register.php?alert=3");
        }
    }
?>