<?php
    include("koneksi.php");
    SESSION_START();
     $id = $_SESSION['id_user'];
     $nama = $_POST['nama'];
     $email = $_POST['email'];
     $dob = $_POST['dob'];
     $telp = $_POST['telp'];
     $alamat =$_POST['alamat'];
     $domisili=$_POST['domisili'];
     $kodepos = $_POST['kodepos'];
     $blok = $_POST['blok'];
     if(!empty($_POST["delivery"])){
        $delivery = $_POST['delivery'];
    }

    

    if ($nama == '' || $email== '' || $dob == ''  || $telp== '' || $alamat== ''  || $domisili== '' || $blok == ''|| $kodepos== '' || !$delivery ){
        header("location:../profile.php?alert=1");
    }else {
        $alamat = $alamat.", ".$blok.", ".$kodepos;
       echo $query = "UPDATE user SET 
        nama_u= '$nama' ,
        email_u= '$email' , 
        dob_u= '$dob' , 
        telp_u= '$telp' , 
        alamat_u= '$alamat' , 
        alamat_pengiriman = '$delivery' WHERE id_user = '$id'";
        $jalan = mysqli_query($koneksi, $query);
        
        if($jalan){
            $_SESSION['nama_u'] = $nama;

            header("location:../profile.php?alert=2");
        }
        else {
            header("location:../profile.php?alert=3");
        }
    }
    
    
  
        
?>