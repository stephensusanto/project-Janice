<?php
    include("koneksi.php");
    if(!empty($_POST["nama"])){
        $nama = $_POST['nama'];
    }
        $status=$_POST['status'];
    
   

    if(!$nama || $status == ''){  
        header("location:../domisili.php?alert=1");
    }else {
        $ttl = date("Y/m/d H:m:s");
        $query = "INSERT INTO domisili (nama_dom, status_dom)
        VALUES ('".$nama."','".$status."')";
        $jalan = mysqli_query($koneksi,$query);
        if($jalan){
            header("location:../domisili.php?alert=2");
        }
        else {
            header("location:../domisili.php?alert=3");
        }
    }
?>