<?php
    include("koneksi.php");

     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $dob = $_POST['dob'];
     $pass = md5($_POST['pass']);
     $passb = md5($_POST['passb']);
     $telp = $_POST['telp'];
     $alamat =$_POST['alamat'];
     $domisili=$_POST['domisili'];
     $kodepos = $_POST['kodepos'];
     $blok = $_POST['blok'];
     $level = $_POST['level'];
     if(!empty($_POST["deliv"])){
        $delivery = $_POST['deliv'];
    }
    

    if ($nama == '' || $email== '' || $dob == '' || $pass == '' || $telp== '' || $alamat== ''  || $domisili== '' || $blok == ''|| $kodepos== '' || !$delivery || $level == ''){
        header("location:../register.php?alert=1");
    }else {
        if($pass != $passb){
            header("location:../register.php?alert=1");
        }else {
            $ttl = date("Y/m/d H:m:s");
            $alamat = $alamat.", ".$blok.", ".$kodepos;
            echo $query = "INSERT INTO user (nama_u, email_u, dob_u, telp_u, alamat_u, tanggal_daftar, password_u, fk_id_level, fk_id_domisili, status_u,alamat_pengiriman)
            VALUES ('".$nama."', '".$email."', '".$dob."', '".$telp."','".$alamat."', now(),'".$pass."','$level','".$domisili."','2', '$delivery')";
            $jalan = mysqli_query($koneksi,$query);
            if($jalan){
            
            header("location:../register.php?alert=2");
            }
            else {
            header("location:../register.php?alert=3");
            }
        }
    }
?>